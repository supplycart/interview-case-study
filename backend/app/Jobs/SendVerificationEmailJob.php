<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\UserVerificationEmail; // Your custom Mailable
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // For error logging

class SendVerificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 2;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = [60, 180]; // Retry after 1 min, then 3 mins

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Ensure the user model is fresh if it was serialized
            $this->user->refresh();

            // Check if email is already verified before sending
            if (!$this->user->hasVerifiedEmail()) {
                Mail::to($this->user->getEmailForVerification())->send(new UserVerificationEmail($this->user));
                Log::info("Verification email sent to: " . $this->user->email);
            } else {
                Log::info("Verification email skipped for already verified user: " . $this->user->email);
            }
        } catch (\Exception $e) {
            Log::error("Failed to send verification email to {$this->user->email}: " . $e->getMessage(), [
                'user_id' => $this->user->id,
                'exception' => $e
            ]);
            // Release the job back to the queue for another attempt if it's a temporary issue
            $this->release(60); // Release for 60 seconds
            // Or just let the $tries and $backoff handle retries.
            throw $e; // Re-throw to allow Laravel to handle job failure and retries
        }
    }

    /**
     * The job failed to process.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        // Send notification to admin, log extensively, etc.
        Log::critical("SendVerificationEmailJob FAILED for user {$this->user->email}: " . $exception->getMessage(), [
            'user_id' => $this->user->id
        ]);
    }
}

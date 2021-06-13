using System;
using System.Net;
using System.Net.Mail;
using System.Threading.Tasks;

namespace backend.Model
{
  public class Mailer
  {
    public void SendEmail(string email, string subject, string body)
    {
      using (SmtpClient smtpClient = new SmtpClient())
      {
        var basicCredential = new NetworkCredential("FROMADDRESS", "FROMPASSWORD");
        using (MailMessage message = new MailMessage())
        {
          MailAddress fromAddress = new MailAddress("FROMADDRESS");

          smtpClient.Host = "YOURSMTPHOST";
          smtpClient.UseDefaultCredentials = false;
          smtpClient.Credentials = basicCredential;

          message.From = fromAddress;
          message.Subject = subject;
          message.IsBodyHtml = true;
          message.Body = body;
          message.To.Add(email);

          try
          {
            smtpClient.Send(message);
          }
          catch (Exception ex)
          {
            System.Console.WriteLine($"{ex.Message} | {ex.StackTrace}");
          }
        }
      }
    }
  }
}
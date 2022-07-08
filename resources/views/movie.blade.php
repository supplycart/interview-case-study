<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <movie
                submit-route="{{ route('movie.create') }}"
                :movie-data="{{ $movie }}"
                :actor-data="{{ $actor }}"
                :producer-data="{{ $producer }}"
            ></movie>
        </div>
    </div>
</x-app-layout>
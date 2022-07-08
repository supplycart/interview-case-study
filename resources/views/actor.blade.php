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
            <actor
                submit-route="{{ route('actor.create') }}"
                :actor-data="{{ $actor }}"
            ></actor>
        </div>
    </div>
</x-app-layout>
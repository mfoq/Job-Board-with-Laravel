<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index') ,
                                        $job->title => route('jobs.show', $job),
                                        'Apply' => '#']"/>

    <x-job-card :$job>

    </x-job-card>

    <x-card>
        <h2 class="mb-4 text-lig font-medium">
            You Job Application
         </h2>

         <form action="{{ route('job.application.store', $job) }}" method="POST" enctype="multipart/form-data" >
            @csrf

            <div class="mb-4 flex gap-4 items-center">
                <x-label for="expected_salary"  :required="true">Expected Salary:</x-label>
                <div class="flex-1 relative">
                    <x-text-input type="number" name="expected_salary"/>
                </div>
            </div>

            <div class="mb-4 flex gap-4 items-center">
                <x-label for="cv" required="true">Upload CV</x-label>
                <div class="flex-1 relative">
                    <x-text-input type="file" name="cv"/>
                </div>
            </div>

            <x-button class="w-full" >Apply</x-button>
         </form>
    </x-card>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

</x-layout>

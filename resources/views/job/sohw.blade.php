<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']"/>

    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
       </p>

       @if(auth()->check())
            @can('apply', $job)
                <x-link-button :href="route('job.application.create', $job)">
                    Apply
                </x-link-button>
            @else
                <div class="text-center text-sm font-medium text-slate-700">
                    You Applied For This Job Before!
                </div>
            @endcan
        @else <!-- For guest users, always show the Apply button -->
            <x-link-button :href="route('job.application.create', $job)">
                Apply
            </x-link-button>
        @endif


    </x-job-card>

    <x-card class="mb-4">
       <h2 class="mb-4 text-lig font-medium">
        More {{ $job->employer->company_name }} Jobs
       </h2>

       <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $otherEmployerJob )
                @if($otherEmployerJob->id != $job->id)
                    <div class="mb-4 flex justify-between">
                        <div>
                            <div class="text-slate-700">
                                <a href="{{ route('jobs.show', $otherEmployerJob) }}">
                                    {{ $otherEmployerJob->title }}
                                </a>
                            </div>
                            <div class="text-xs">
                                {{ $otherEmployerJob->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-xs">${{ number_format($otherEmployerJob->salary)}}</div>
                    </div>
                @endif
            @endforeach
       </div>
    </x-card>

</x-layout>

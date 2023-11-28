<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job Applications' => '#']">

    </x-breadcrumbs>

    @forelse ($applications as $application )
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div class="mt-1">
                        You Expected Salary ${{ number_format($application->expected_salary) }}
                    </div><div class="mt-1">
                        Average Expected  Salary ${{ number_format($application->job->job_applications_avg_expected_salary) }}
                        By {{ $application->job->job_applications_count - 1}} {{ Str::plural('Applicant', $application->job->job_applications_count - 1)}}
                    </div>
                </div>
                <div>
                   <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST"">
                        @csrf
                        @method('DELETE')
                        <x-button>Cancel</x-button>
                   </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8 text-red-50">
            <div class="text-center font-medium">
                No Jobs Applications Yet!
            </div>
            <div  class="text-center">
                Find Some Jobs <a class="text-white-500 font-bold hover:underline" href="{{ route('jobs.index') }}"> Here! </a>
            </div>
        </div>
    @endforelse
</x-layout>

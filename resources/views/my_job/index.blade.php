<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#']" class="mb-4"/>

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}">Create Job Offer</x-link-button>
    </div>

    @forelse ( $jobs as $job)
        <x-job-card :job="$job">
            <div class="text-xs text-slate-500">
                @forelse ($job->jobApplications as $applicant )
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                                <div>{{ $applicant->user->name }}</div>
                                <div> Applied {{ $applicant->created_at->diffForHumans() }}</div>
                                <div>Download Cv</div>
                        </div>
                        <div>
                            ${{ number_format($applicant->expected_salary) }}
                        </div>
                    </div>
                @empty
                    <div>No Applications yes</div>
                @endforelse

                <div class="flex space-x-2">
                    <x-link-button :href="route('my-jobs.edit', $job)">Edit</x-link-button>

                    <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <x-button>Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8 text-white">
           <div class="text-center font-medium">
                No Jobs Yet
           </div>
            <div class="text-center">
                Post Your First job <x-link-button  :href="route('my-jobs.create')">Here!</x-link-button>
           </div>
        </div>
    @endforelse

</x-layout>

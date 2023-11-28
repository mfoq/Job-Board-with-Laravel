<x-layout>
    <x-card class="py-8 px-16">

        <h1 class="scroll-my-16 text-center text-4xl font-medium text-slate-600">
            Sign In
        </h1>

        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <div class="mb-8">
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email" />
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password"/>
            </div>

            <div class="mb-8 flex justify-between text-sm">
                <div>
                    <div class="flex gap-1 items-center">
                        <input type="checkbox" name="" id="remember"class="rounded-sm border border-slate-400">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                <div href="#" class="text-indigo-600 hover:underline">Forget Password?</div>
            </div>

            <x-button class="w-full bg-green-50">Log in</x-button>
        </form>
    </x-card>
</x-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Mental Health Clinic Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Welcome!</h3>
                <p class="text-gray-700">
                    Welcome to our Mental Health Clinic Management System. Here, we prioritize your mental well-being and aim to provide comprehensive support. Explore the various tools and resources available to enhance your experience.
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Mental Health Awareness</h3>
                <p class="text-gray-700">
                    At our clinic, we're committed to raising awareness about mental health. Check out our resources section to learn about different mental health conditions, coping strategies, and self-care tips.
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">World Mental Health Support </h3>
                
                <img src="https://www.ge.com/research/sites/default/files/inline-images/world-mental-health-day_900.jpg" alt="Mental Health Stats" class="w-full h-auto">
                <p class="text-gray-700">
                    Visual representations of World Mental Health Support Da that happen on October 10 yearly.
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Services Offered</h3>
                
                <img src="https://abbotscare.com/wp-content/uploads/2021/12/xx2wtblr3r8-1255x837.jpg.webp" alt="Services Offered" class="w-full h-auto">
                <p class="text-gray-700">
                    Our clinic provides a range of services including counseling, therapy sessions, support groups, and more. Explore the services section to learn about what we offer and how we can assist you.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

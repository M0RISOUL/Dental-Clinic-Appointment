<x-navbar-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-b from-teal-50 to-white py-16">
        <div class="absolute top-0 left-0 w-full h-64 bg-teal-50 transform -skew-y-6"></div>

        <!-- Doctor Section -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-teal-600 font-semibold text-lg mb-4 block">Meet Our Experts</span>
                <h1 class="text-4xl font-bold text-gray-900 mb-6">
                    Our Distinguished Doctors
                </h1>
                <div class="w-24 h-1 bg-teal-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Providing exceptional dental care with expertise and compassion
                </p>
            </div>

            <!-- Doctor Card -->
          <div class="mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($doctor as $doctor)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover-card mb-8 flex flex-col">
                        <div class="flex flex-col md:flex-row flex-1">
                            <div class="md:w-1/2">
                                <img src="{{ $doctor->image && Storage::disk('public')->exists($doctor->image) ? asset('storage/' . $doctor->image) : asset('images/default-avatar.png') }}" alt="Dr. {{ $doctor->name }}"
                                     class="w-full h-full object-cover object-center" style="min-height: 400px;">
                            </div>
                            <div class="md:w-1/2 p-8 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center mb-6">
                                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h2 class="text-2xl font-bold text-gray-900">Dr. {{ $doctor->name }}</h2>
                                            <p class="text-teal-600 font-medium">{{ $doctor->position }}</p>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        @foreach(explode(',', $doctor->description) as $desc)
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-teal-500 mr-3" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                                <span class="text-gray-600">{{ $desc }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-8 flex-grow flex items-end">
                                    <a href="{{route('patient.dashboard')}}" class="inline-flex items-center px-6 py-3 bg-teal-500 text-white font-semibold rounded-lg 
                                                          transition-all duration-300 hover:bg-teal-600 hover:shadow-lg">
                                        Book an Appointment
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Staff Section -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
            <div class="text-center mb-16">
                <span class="text-teal-600 font-semibold text-lg mb-4 block">Our Team</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Meet Our Professional Staff
                </h2>
                <div class="w-24 h-1 bg-teal-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Dedicated professionals committed to providing you with the best dental care experience
                </p>
            </div>

          <!-- Staff Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($personnel as $person)
        <div class="group">
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                
                <!-- Image Container -->
                <div class="flex justify-center items-center w-full h-96 sm:h-48 md:h-56 lg:h-64 overflow-hidden bg-gray-100">
                    <img class="object-cover object-center w-full h-full"
                        src="{{ $person->image && Storage::disk('public')->exists($person->image) ? asset('storage/' . $person->image) : asset('images/logo.png') }}"
                        alt="{{ $person->name }} image">
                </div>

                <!-- Info Content -->
                <div class="p-4 pt-2 bg-teal-50 text-center flex-1 flex flex-col justify-between">
                    
                    <div>
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mx-auto mt-4">
                            <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-teal-800 mt-2">{{ $person->name }}</h3>
                        <p class="text-sm text-teal-600 mb-2">{{ $person->position }}</p>
                        <p class="text-sm text-gray-600">
                            {{ implode(' ', array_slice(explode(' ', $person->description), 0, 6)) }}{{ strlen($person->description) > 0 ? '...' : '' }}
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center space-x-4">
                        @if($person->facebook)
                            <a href="{{ $person->facebook }}" class="text-gray-500 hover:text-teal-600" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($person->instagram)
                            <a href="{{ $person->instagram }}" class="text-gray-500 hover:text-teal-600" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($person->twitter)
                            <a href="{{ $person->twitter }}" class="text-gray-500 hover:text-teal-600" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>


            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-20">
                <div
                    class="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-4xl font-bold text-teal-500 mb-2">4+</div>
                    <div class="text-gray-600">Team Members</div>
                </div>
                <div
                    class="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-4xl font-bold text-teal-500 mb-2">5+</div>
                    <div class="text-gray-600">Years Experience</div>
                </div>
                <div
                    class="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-4xl font-bold text-teal-500 mb-2">1000+</div>
                    <div class="text-gray-600">Happy Patients</div>
                </div>
                <div
                    class="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-4xl font-bold text-teal-500 mb-2">100%</div>
                    <div class="text-gray-600">Satisfaction Rate</div>
                </div>
            </div>

            <!-- Join Our Team CTA -->
            <div class="mt-20 bg-gradient-to-r from-teal-500 to-teal-600 rounded-3xl shadow-xl p-12 text-center">
                <h3 class="text-3xl font-bold text-white mb-4">Join Our Growing Team</h3>
                <p class="text-teal-100 text-lg mb-8 max-w-2xl mx-auto">
                    We're always looking for talented and passionate individuals to join our dental family.
                    If you're committed to providing exceptional patient care, we'd love to hear from you.
                </p>
                <a href="/careers" class="inline-flex items-center px-8 py-4 bg-white text-teal-600 font-semibold rounded-xl 
                          transition-all duration-300 hover:bg-teal-50 hover:scale-105 hover:shadow-lg">
                    View Career Opportunities
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <style>
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
        }

        .staff-image-hover {
            transition: all 0.3s ease;
        }

        .staff-card:hover .staff-image-hover {
            transform: scale(1.05);
        }
    </style>

    <x-chatbot />
    <x-footer />
</x-navbar-layout>
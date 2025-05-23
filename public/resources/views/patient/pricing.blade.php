<x-patientnav-layout>
    <div class="py-12">
        <div class="max-w-8xl mx-auto lg:px-8 grid lg:gap-8 gap-4 lg:grid-cols-1 md:grid-cols-1 sm:grid-cols-1">
            <section
                class="bg-gradient-to-r from-white to-gray-50 border-t-4 border-b-4 border-teal-600 shadow-lg rounded-lg">
                <div class="py-8 px-4 mx-auto max-w-screen-3xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-lg text-center mb-8 lg:mb-12">
                        <h2
                            class="mb-4 text-4xl tracking-tight font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-blue-400">
                            {{ $pricing_title }}
                        </h2>

                        <p class="mb-5 font-normal text-gray-500 sm:text-xl">{{ $pricing_description }}</p>
                    </div>

                    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                        <!-- Braces -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-4 text-2xl font-semibold">{{ $braces['type'] }}</h3>
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold">₱{{ number_format($braces['total_package']) }}</span>
                                <span class="text-gray-500">Total Package</span>
                            </div>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>
                            <!-- List -->
                            <ul role="list" class="text-left">
                                <div class="rounded-lg border-2 bg-white p-4 space-y-6 border-teal-500 h-full">
                                    <li class="flex items-center space-x-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Low DP Promo: ₱{{ number_format($braces['low_dp_promo']) }}</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Monthly Adjustment: ₱{{ number_format($braces['monthly_adjustment']) }}</span>
                                    </li>
                                    @foreach($braces['inclusions'] as $inclusion)
                                        <li class="flex items-center space-x-3">
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ $inclusion }}</span>
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <!-- General Procedure -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-4 text-2xl font-semibold">General Procedure</h3>
                            <p class="font-light text-gray-500 sm:text-lg">(Base price; depends upon the case)</p>
                            <div class="flex justify-center items-baseline my-5">
                                <span class="mr-2 text-5xl font-extrabold">Varies</span>
                            </div>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>
                            <div class="rounded-lg border-2 bg-white p-4 space-y-6 border-teal-500 h-full">
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    @foreach($generalProcedure as $procedure => $price)
                                        <li class="flex items-center space-x-3">
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ ucwords(str_replace('_', ' ', $procedure)) }}: {{ $price }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Teeth Whitening -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-2 text-2xl font-semibold">Teeth Whitening</h3>
                            <p class="font-light text-gray-500 sm:text-lg">{{ $teethWhitening['description'] }}</p>
                            <div class="flex justify-center items-baseline mb-2">
                                <span class="mr-2 mt-10 text-5xl font-extrabold">₱{{ number_format($teethWhitening['promo_price']) }}</span>
                                <span class="text-gray-500 truncate">Promo Price</span>
                            </div>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>
                            <div class="rounded-lg border-2 p-4 space-y-6 bg-white border-teal-500 h-full">
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Original Price: ₱{{ number_format($teethWhitening['original_price']) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Dentures -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-4 text-2xl font-semibold">Dentures</h3>
                            <p class="font-light text-gray-500 truncate sm:text-lg">Pricing details for complete and partial dentures</p>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>
                            <div class="rounded-lg border-2 bg-white p-4 space-y-6 border-teal-500 h-full">
                                <h4 class="my-4 text-xl font-semibold">Complete Denture</h4>
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    @foreach($dentures['complete_denture'] as $type => $prices)
                                        <li>
                                            <strong>{{ ucwords(str_replace('_', ' ', $type)) }}:</strong>
                                            <ul class="ml-4 list-disc space-y-4">
                                                <li class="flex items-center space-x-3">
                                                    <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>Per Arch: ₱{{ number_format($prices['per_arch']) }}</span>
                                                </li>
                                                <li class="flex items-center space-x-3">
                                                    <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>Upper &amp; Lower: ₱{{ number_format($prices['upper_lower']) }}</span>
                                                </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Partial Denture Section -->
                                <h4 class="my-4 text-xl font-semibold">Partial Denture</h4>
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    @foreach($dentures['partial_denture'] as $type => $prices)
                                        <li>
                                            <strong>{{ ucwords(str_replace('_', ' ', $type)) }}:</strong>
                                            <ul class="ml-4 list-disc space-y-4">
                                                @foreach($prices as $option => $value)
                                                    <li class="flex items-center space-x-3">
                                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span>{{ ucwords(str_replace('_', ' ', $option)) }}: ₱{{ number_format($value) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Fixed Bridge and Crowns -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-4 text-2xl font-semibold truncate">Fixed Bridge and Crowns</h3>
                            <p class="font-light text-gray-500 truncate sm:text-lg">Pricing details for fixed bridges and crowns</p>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>
                            <div class="rounded-lg border-2 bg-white p-4 space-y-6 border-teal-500 h-full">
                                <!-- Pricing List -->
                                <ul role="list" class="my-4 space-y-4 text-left">
                                    @foreach($fixedBridgeAndCrowns as $key => $value)
                                        @if(is_array($value))
                                            <strong style="margin-top:40px" class="block">{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                            <li>
                                                <ul class="space-y-4 list-disc">
                                                    @foreach($value as $subKey => $subValue)
                                                        <li class="mt-4 flex items-center space-x-4">
                                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span>{{ ucwords(str_replace('_', ' ', $subKey)) }}: ₱{{ number_format($subValue) }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li class="flex items-center space-x-3">
                                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span>{{ ucwords(str_replace('_', ' ', $key)) }}: ₱{{ number_format($value) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                <!-- Veneers Section -->
                                <h4 class="my-4 text-xl font-semibold">Veneers</h4>
                                <ul role="list" class="mb-6 space-y-4 text-left">
                                    @foreach($veneers as $type => $price)
                                        <li class="flex items-center space-x-4">
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ ucwords($type) }}: ₱{{ number_format($price) }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Retainers Section -->
                                <h4 class="my-4 text-xl font-semibold">Retainers</h4>
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    @foreach($retainers as $retainerType => $details)
                                        <li>
                                            <strong>{{ ucwords(str_replace('_', ' ', $retainerType)) }}:</strong>
                                            <ul class="ml-4 list-disc space-y-4">
                                                @foreach($details as $option => $value)
                                                    <li class="flex items-center space-x-4">
                                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span>{{ ucwords(str_replace('_', ' ', $option)) }}: ₱{{ number_format($value) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Xray & Root Canal Treatment -->
                        <div
                            class="flex flex-col p-6 mx-auto max-w-xl text-center text-gray-900 bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg border border-teal-500 shadow xl:p-8 w-full h-full transform hover:scale-105 transition-transform duration-200">
                            <h3 class="mb-4 lg:text-2xl md:text-lg sm:text-lg truncate font-semibold">Xray & Root Canal Treatment</h3>
                            <p class="font-light text-gray-500 truncate sm:text-lg">Detailed pricing for Xray services and Root Canal Treatment</p>
                            <a href="{{ route('calendar') }}"
                                class="text-white shadow-lg my-8 bg-gradient-to-r from-teal-500 to-blue-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-lg px-5 py-2.5 text-center">
                                Get Started
                            </a>

                            <div class="rounded-lg border-2 bg-white p-4 space-y-6 border-teal-500 h-full">
                                <h4 class="mt-4 text-xl font-semibold">Xray</h4>
                                <ul role="list" class="mb-6 space-y-4 text-left">
                                    @foreach($xray as $type => $price)
                                        <li class="flex items-center space-x-3">
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ ucwords(str_replace('_', ' ', $type)) }}: ₱{{ number_format($price) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <h4 class="my-4 text-start text-xl font-semibold">Root Canal Treatment (Anterior Only)</h4>
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    @foreach($rootCanalTreatment['anterior_only'] as $key => $value)
                                        @if($key !== 'includes')
                                            <li class="flex items-center space-x-3">
                                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span>{{ ucwords(str_replace('_', ' ', $key)) }}: ₱{{ number_format($value) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="flex items-center space-x-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Includes: {{ $rootCanalTreatment['anterior_only']['includes'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-patientnav-layout>
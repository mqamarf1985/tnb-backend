<div>
    {{--    {{ dd($chart) }}--}}
    {{--    {{ dd($contractOne_chart) }}--}}
    {{--{{ dd(wire:live="getChartData") }}--}}
    <!-- HEADER -->
    <x-header title="Dashboard" separator progress-indicator>

    </x-header>


    <div class="bg-white ">
        <div class="mx-auto">
            <div
                class="mt-2 grid  grid-cols-1 gap-x-4 gap-y-16  pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                <x-card class="group relative self-center">
                    <x-chart wire:model="chartOne" class=" self-center"/>
                    <h3 class="mt-3 text-lg text-center font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        Contact One
                    </h3>
                </x-card>
                <x-card class="group relative self-center">
                    <x-chart wire:model="chartTwo"/>
                    <h3 class="mt-3 text-lg text-center font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        Contact Two
                    </h3>
                </x-card>
                <x-card class="group relative self-center">
                    <x-chart wire:model="chartThree"/>
                    <h3 class="mt-3 text-lg text-center font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        Contact Three
                    </h3>
                </x-card>
                <x-card class="group relative self-center">
                    <x-chart wire:model="chartFour"/>
                    <h3 class="mt-3 text-lg text-center font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        Contact Four
                    </h3>
                </x-card>
            </div>
        </div>
    </div>

</div>

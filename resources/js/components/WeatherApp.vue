<template>
    <div class="text-white mb-8">
        <div class="places-input text-gray-800">
            <input type="text" class="w-full" placeholder="Enter city"> 
        </div>
        <div class="weather-container font-sans w-128 max-w-lg rounded-lg overflow-hidden bg-gray-900 shadow-lg mt-4">
            <div class="current-weather flex items-center justify-between px-6 py-8">
                <div class="flex items-center">
                    <div>
                        <div class="text-6xl font-semibold">{{currentTemperature.actual}}°C</div>
                        <div>Feels like {{currentTemperature.feelslk}}°C</div>
                    </div>
                    <div class="mx-5">
                        <div class="font-semibold">{{currentTemperature.summary}}</div>
                        <div>{{location.name}}</div>
                    </div>
                </div>
                <div>
                    <img :src="currentTemperature.icon" alt="Weather icon" class="pulse">
                </div>
            </div> <!-- end current-weather -->

            <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden">
                <div v-for="(day, index) in forecast" :key="index" class="flex items-center mt-8">
                    <div class="w-1/6 text-lg text-gray-200">{{ new Date(day.date).toLocaleDateString('en-US', { weekday: 'short' }).toUpperCase() }}</div>
                    <div class="w-4/6 px-4 flex items-center">
                        <img 
                            :src="day.icon" 
                            :alt="day.summary"
                            :class="day.summary.includes('Sunny') ? 'rotate' : 'pulse'"
                            class="mr-3 weather-icon"
                        >
                        <div>{{ day.summary }}</div>
                    </div>
                    <div class="w-1/6 text-right">
                        <div>{{ day.maxTemp }}°C</div>
                        <div>{{ day.minTemp }}°C</div>
                    </div>
                </div>
            </div> <!-- end future-weather -->

        </div> <!-- end weather-container -->
    </div>
</template>

<script>
export default {
    mounted() {
        this.fetchData()
    },
    data() {
        return {
            currentTemperature: { // Object of temp data
                actual: '',
                feelslk: '',
                summary: '',
                icon: ''  
            },
            location: { // Object of location
                name: 'London, United Kingdom',
                lat: '51.52',
                lon: '-0.11'
            },
            forecast: []  // Array of forecast for 7 days
        };
    },
    methods: {
        fetchData() {
            fetch('/weather?q=London')  // Adjust this endpoint as necessary
            .then(response => response.json())
            .then(data => {
                // Update current weather data
                this.currentTemperature.actual = Math.round(data.current.temp_c);
                this.currentTemperature.feelslk = Math.round(data.current.feelslike_c);
                this.currentTemperature.summary = data.current.condition.text;
                this.currentTemperature.icon = data.current.condition.icon;

                // Update forecast data
                this.forecast = data.forecast.forecastday.map(day => {
                    return {
                        date: day.date,
                        maxTemp: Math.round(day.day.maxtemp_c),
                        minTemp: Math.round(day.day.mintemp_c),
                        summary: day.day.condition.text,
                        icon: day.day.condition.icon
                    };
                });
            })
            .catch(error => {
                console.error('Error fetching weather data:', error);
            });
        }
    }
}
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reporting Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <!-- Total Patients -->
                <div class="bg-blue-200 p-6 rounded-lg shadow-md count-box" data-target="patientsTable">
        <h3 class="text-lg font-semibold mb-2">Total Patients</h3>
        <p class="text-4xl font-bold">{{ $patientCount }}</p>
        <!-- Pie Chart for Patient Gender -->
        <div style="width: 6cm; height: 6cm;">
            <canvas id="patientGenderChart"></canvas>
        </div>
    </div>
     <!-- Table for Patients -->
                <div id="patientsTable" class="hidden">
    <table class="bg-white border border-gray-300 w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact No</th>
                <th>Address</th>
                <th>Email</th>
                <th>Emergency Contact</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Medical History</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($patients as $patient)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-left">{{ $patient->id }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->name ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->contact_no ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->address ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->email ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->emergency_contact ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->date_of_birth ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->gender ?? '-' }}</td>
                <td class="px-4 py-3 text-left">{{ $patient->medical_history ?? '-' }}</td>
                <!-- Add more data corresponding to the columns -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
                <!-- Total Appointments -->
                <div class="bg-green-200 p-6 rounded-lg shadow-md count-box" data-target="appointmentsTable">
                    <h3 class="text-lg font-semibold mb-2">Total Appointments</h3>
                    <p class="text-4xl font-bold">{{ $appointmentCount }}</p>
                    <!-- Pie Chart for Appointments -->
                    <div style="width: 6cm; height: 6cm;">
                        <canvas id="appointmentStatusChart"></canvas>
                    </div>
                </div>

                 <!-- Appointments by Month -->
                 <div class="bg-yellow-200 p-6 rounded-lg shadow-md count-box" data-target="appointmentsByMonthChart">
                    <h3 class="text-lg font-semibold mb-2">Appointments by Month</h3>
                    <div style="width: 6cm; height: 6cm;">
                        <canvas id="appointmentsByMonthChartCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- Table for Appointments -->
                <div id="appointmentsTable" class="hidden">
                    <table class="bg-white border border-gray-300 w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>@lang('crud.appointments.inputs.patient_id')</th>
                                <th>@lang('crud.appointments.inputs.user_id')</th>
                                <th>@lang('crud.appointments.inputs.date_time')</th>
                                <th>@lang('crud.appointments.inputs.status')</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach($appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">{{ $appointment->id }}</td>
                                <td class="px-4 py-3 text-left">{{ $appointment->title }}</td>
                                <td class="px-4 py-3 text-left">{{ $appointment->patient_id }}</td>
                                <td class="px-4 py-3 text-left">{{ $appointment->user_id }}</td>
                                <td class="px-4 py-3 text-left">{{ $appointment->date_time }}</td>
                                <td class="px-4 py-3 text-left">{{ $appointment->status }}</td>
                                <!-- Add more data corresponding to the columns -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Add more count boxes and tables as needed -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ... (existing code remains unchanged) ...

            // Retrieve patient gender data from the controller
            const patientGenderData = {!! json_encode($patientGenderData) !!};

            // Extract labels and values for the pie chart
            const genderLabels = patientGenderData.map(gender => gender.gender);
            const genderValues = patientGenderData.map(gender => gender.count);

            const genderCtx = document.getElementById('patientGenderChart').getContext('2d');
            const patientGenderChart = new Chart(genderCtx, {
                type: 'pie',
                data: {
                    labels: genderLabels,
                    datasets: [{
                        data: genderValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            // Add more colors if needed
                        ],
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                },
            });
        });
    </script>
   
   
   
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countBoxes = document.querySelectorAll('.count-box');

            countBoxes.forEach(box => {
                box.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const targetTable = document.getElementById(targetId);

                    // Toggle visibility of the table
                    targetTable.classList.toggle('hidden');
                });
            });

            // Retrieve appointment status data from the controller
            const appointmentStatusData = {!! json_encode($appointmentStatusData) !!};

            // Extract labels and values for the pie chart
            const labels = appointmentStatusData.map(status => status.status);
            const values = appointmentStatusData.map(status => status.count);

            const ctx = document.getElementById('appointmentStatusChart').getContext('2d');
            const appointmentStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            // Add more colors if needed
                        ],
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                },
            });
        });
    
        document.addEventListener('DOMContentLoaded', function () {
            // Retrieve appointments by month data from the controller
            const appointmentsByMonthData = {!! json_encode($appointmentsByMonthData) !!};

            // Extract labels and values for the pie chart
            const monthLabels = appointmentsByMonthData.map(item => {
                const month = item.month < 10 ? '0' + item.month : item.month;
                return `${item.year}-${month}`;
            });
            const monthValues = appointmentsByMonthData.map(item => item.count);

            const appointmentsByMonthCtx = document.getElementById('appointmentsByMonthChartCanvas').getContext('2d');
            const appointmentsByMonthChart = new Chart(appointmentsByMonthCtx, {
                type: 'pie',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        data: monthValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            // Add more colors if needed
                        ],
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                },
            });
        });
    </script>

</x-app-layout>

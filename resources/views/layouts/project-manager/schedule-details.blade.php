<section class="p-4 bg-light mt-3">
    <div class="row">
        <div class="col-8">
            <h4>Perkembangan Pembangunan</h4>
        </div>
        <div class="col-4">
            <div class="d-inline mx-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addWorkScheduleModal">Tambah Jadwal Pekerjaan</button>
            </div>
            <div class="d-inline mx-2">
                <button class="btn btn-primary" id="print-out">Cetak Laporan</button>
            </div>
        </div>
        <div class="modal fade" id="addWorkScheduleModal" tabindex="-1" aria-labelledby="addWorkScheduleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addWorkScheduleModalLabel">Tambah Jadwal Pekerjaan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <form action="{{ route('schedules.store_work_schedule', ['id' => $schedule->id]) }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="work_stage">Pekerjaan</label>
                                <select name="work_stage" id="work_stage" class="form-select" required>
                                    <option value="" disabled>Pilih...</option>
                                    @foreach ($workStagesOptions as $workStagesOption)
                                        <option value="{{ $workStagesOption->id }}">
                                            {{ $workStagesOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="days">Jumlah Hari Kerja</label>
                                <input type="number" name="days" id="days" min="0"
                                    class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2">
        <h4>Gantt Chart Pembangunan</h4>
        <canvas id="ganttChart"></canvas>
    </div>
    <hr>
    <div class="mt-3">
        <h4>Kurva S Pembangunan</h4>
        <canvas id="kurvaS"></canvas>
    </div>
</section>

<section id="dangerZone" class="alert alert-danger p-3 mt-3">
    <h4>Danger Zone</h4>
    <p><strong>Apakah anda yakin ingin menghapus jadwal ini?</strong></p>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteScheduleModal">Hapus
        Jadwal</button>
</section>

<div class="modal fade" id="deleteScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteScheduleModalLabel">Konfirmasi Hapus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
            </div>
            <form action="#" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $schedule->id }}">
                    <label for="name">Masukkan nama schedule anda!</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" disabled>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

<script>
    const getWorkingDays = (startDate, completionDate) => {
        let workingDays = 0;

        const currentDate = new Date(startDate);
        while (currentDate <= completionDate) {
            if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6) {
                workingDays++;
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return workingDays;
    };

    const ganttChart = document.getElementById('ganttChart').getContext('2d');
    const kurvaS = document.getElementById('kurvaS').getContext('2d');

    const ganttChartData = new Chart(ganttChart, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($workStages as $workStage)
                    '{!! $workStage->name !!}',
                @endforeach
            ],
            datasets: [{
                    label: 'Progress Pembangunan',
                    data: [
                        @foreach ($workSchedules as $workSchedule)
                            ['{!! $workSchedule->start_date !!}', '{!! $workSchedule->completion_date !!}'],
                        @endforeach
                    ],
                    backgroundColor: '#6FA8DC',
                    borderSkipped: false,
                },
                {
                    label: 'Aktualisasi Pembangunan',
                    data: [
                        @foreach ($completedWorkSchedules as $completedWorkSchedule)
                            ['{!! $completedWorkSchedule->start_date !!}', '{!! $completedWorkSchedule->completed_at !!}'],
                        @endforeach
                    ],
                    backgroundColor: '#AFE689',
                    borderSkipped: false,
                }
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    position: 'top',
                    type: 'time',
                    time: {
                        unit: 'week'
                    },
                    min: '{{ $schedule->start_date }}',
                    // max: '{{ $schedule->completion_date }}',
                    grid: {
                        borderDash: [5, 5]
                    }
                },
                y: {
                    beginAtZero: true,
                    labels: [
                        @foreach ($workStages as $workStage)
                            '{!! $workStage->name !!}',
                        @endforeach
                    ],
                    ticks: {
                        callback(value, index) {
                            const maxLength = 30;
                            const strValue = this.getLabelForValue(value).toString();
                            return strValue.length > maxLength ? `${strValue.substring(0, maxLength)}...` :
                                strValue
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = JSON.parse(context.formattedValue);
                            const options = {
                                year: "numeric",
                                month: "short",
                                day: "numeric"
                            }

                            const formatDate = date => new Date(date).toLocaleDateString("id-ID", options);
                            const startDate = formatDate(value[0]);
                            const completionDate = formatDate(value[1]);
                            const workingDays = getWorkingDays(value[0], value[1]) - 1;
                            const label =
                                `${context.dataset.label}: ${startDate} - ${completionDate} (${workingDays} hari kerja)` ||
                                '';

                            return label;
                        }
                    }
                }
            }
        }
    });

    const kurvaSData = new Chart(kurvaS, {
        type: 'line',
        data: {
            datasets: [{
                    label: 'Progress Pembangunan',
                    data: [
                        @foreach ($workSchedules as $index => $workSchedule)
                            {
                                x: '{!! $workSchedule->start_date !!}',
                                y: '{{ ($index / 23) * 100 }}'
                            },
                        @endforeach
                    ],
                    backgroundColor: '#6FA8DC',
                    borderSkipped: false,
                },
                {
                    label: 'Aktualisasi Pembangunan',
                    data: [
                        @foreach ($completedWorkSchedules as $index => $completedWorkSchedule)
                            {
                                x: '{!! $completedWorkSchedule->completed_at !!}',
                                y: '{{ (($index + 1) / 23) * 100 }}'
                            },
                        @endforeach
                    ],
                    backgroundColor: '#AFE689',
                    borderSkipped: false,
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'week',
                    },
                    min: '{{ $schedule->start_date }}',
                    title: {
                        display: true,
                        text: 'Waktu Pembangunan'
                    }
                },
                y: {
                    type: 'linear',
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: (tooltipItem, data) => {
                            return false;
                        },
                        label: (context) => {
                            return false;
                        }
                    }
                }
            }
        }
    });

    // Print To PDF
    window.jsPDF = window.jspdf.jsPDF;

    const printToPdf = (e) => {
        e.preventDefault();

        alert('Mempersiapkan PDF Laporan');

        const pdf = new jsPDF('l', 'mm', 'a4');
        pdf.setFont('Helvetica', 'bold');
        const width = pdf.internal.pageSize.getWidth();
        const height = pdf.internal.pageSize.getHeight();

        pdf.setFontSize(18);
        pdf.text("Laporan Pembangunan Kapal", width / 2, 10, {
            align: "center"
        });

        pdf.line(0, 20, width, 20);

        pdf.setFontSize(14);
        pdf.text("Informasi Pembangunan Kapal", 10, 30);

        const data = [
            ["Nama Pembangunan", "{{ $schedule->name }}"],
            ["Jam Pembangunan per Hari", "{{ $schedule->working_hours }}"],
            ["Waktu Pembangunan",
                "{{ formatDate($schedule->start_date) }} - {{ formatDate($schedule->completion_date) }}"
            ]
        ];

        pdf.autoTable({
            startY: 35,
            body: data,
            theme: 'grid',
        });

        const ganttChartImageData = ganttChartData.toBase64Image();
        const kurvaSImageData = kurvaSData.toBase64Image();

        console.log(kurvaSImageData);

        pdf.text('Gantt Chart Pembangunan Kapal', 10, 75);
        pdf.addImage(ganttChartImageData, 'PNG', 0, 80, width, 125);

        pdf.addPage();

        pdf.text('Kurva S Pembangunan Kapal', 10, 10);
        pdf.addImage(kurvaSImageData, 'PNG', 0, 20, width, 125);

        pdf.save('Laporan_Pembangunan_Kapal.pdf');
    }

    document.getElementById('print-out').addEventListener('click', printToPdf);
</script>
@if (session('message'))
    <script>
        alert("{{ session('message') }}");
    </script>
@endif

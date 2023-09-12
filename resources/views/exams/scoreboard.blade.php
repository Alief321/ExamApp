@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Scoreboard Exam</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Exams Title : {{ $exam->name }}</h4>
                </div>
                @if (count($students) == 0)
                    <h5>No Students Assign For This Exams</h5>
                @else
                    <div class="card-body">
                        <h5 class="mb-2">Total Students Assign = {{ $students->count() }} Students</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">SCORE</th>
                                    <th scope="col">ESSAY</th>
                                    {{-- <th scope="col" style="width: 15%;text-align: center">AKSI</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $no => $student)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ++$no + ($students->currentPage()-1) * $students->perPage() }}</th>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->pivot->score }}</td>
                                        @php
                                            $essay = json_decode($student->pivot->essay);
                                            $values = "";
                                            $i=0;
                                            foreach ($essay as $key => $value) {
                                                if ($i==0) {
                                                    $values = $value ;
                                                }
                                                else{
                                                    $values = $values . ", " . $value ;
                                                }
                                                $i++;
                                            }
                                        @endphp
                                        <td>{{ $values }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                {{ $students->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>
</div>

@stop
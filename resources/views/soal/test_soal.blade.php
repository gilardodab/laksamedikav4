@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Mulai Test KnowLedge</b>
                            </div>
                            <!--Countdown-->
                            <div class="col-md-6">
                            <p id="element">Mulai</p>
                            <Script>
                                function countdown(element, minutes, seconds) {
                            // set time for the particular countdown
                            var time = minutes*60 + seconds;
                            var interval = setInterval(function() {
                                var el = document.getElementById('element');
                                // if the time is 0 then end the counter
                                if(time == 0) {
                                    setTimeout(function() {
                                        el.innerHTML = "Waktu Anda Habis...";
                                    }, 10);
                            
                            
                                    clearInterval(interval);
                            
                                    setTimeout(function() {
                                        countdown('clock', 0, 0);
                                    }, 10000);
                                }
                                var minutes = Math.floor( time / 60 );
                                if (minutes < 10) minutes = "0" + minutes;
                                var seconds = time % 60;
                                if (seconds < 10) seconds = "0" + seconds; 
                                var text = minutes + ':' + seconds;
                                el.innerHTML = text;
                                time--;
                            }, 1000);
                            }
                            countdown('clock', 0, 120);
                                </script>
                            </div>    
                            <!--Countdown-->

                        </div>
                    </div>
                    <div class="table-responsive">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Soal Test Knowledge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                @forelse($soaldetails as $e=>$soaldetail)
                                <tr>
                                    <!-- MENAMPILKAN VALUE DARI TITLE -->
                                    {{-- <td colspan="1" align="center">{{ $e+1 }}</td> --}}
                                    <td align="left">{{ $soaldetail->soal }}<br>
                                        <form action="{{ route('save.jawaban' , $soaldetail->id) }}" method="POST">
                                            <!-- @csrf ADALAH DIRECTIVE UNTUK MEN-GENERATE TOKEN CSRF -->
                                            @csrf
                                            <input type="hidden" name="soal_id" value="{{$soals->id}}">
                                            <input type="hidden" name="soal_detail_id" value="{{$soaldetail->id}}">
                                            <input type="hidden" name="soal" value="{{$soaldetail->soal}}">
                                            <textarea type="text" name="jawaban" class="form-control"></textarea><br>   
                                            <button class="btn btn-primary btn-sm">Jawab</button>                          
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">Empty Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{-- {{ $allinvoice->links() }} --}}
                            @if(isset($soaldetails))
                            {{-- @if($soaldetails->currentPage() > 1)
                                <a class="btn btn-primary btn-sm" href="{{ $soaldetails->previousPageUrl() }}">Previous</a>
                            @endif --}}
                            
                            @if($soaldetails->hasMorePages())
                                <a class="btn btn-primary btn-sm" href="{{ $soaldetails->nextPageUrl() }}">Next</a>
                            @endif
                            @endif

                            @if(isset($soaldetails))
                            @if($soaldetails->hasMorePages())
                            <script>
                                setTimeout(function() {
                                    window.location.href = "{{ $soaldetails->nextPageUrl() }}"
                                }, 120000); // 2 second
                            </script>
                            @endif
                            @endif

                            @if(isset($soaldetails))
                            @if($soaldetails->lastPage())
                            <script type="text/javascript">
                                function getUrl()
                                {
                                    return "{{ url('soal') }}";
                                }
                            </script>
                            <a class="btn btn-primary btn-sm" href="#" onClick="confirm('Anda yakin ingin mengakhiri tes ini?');document.location.href=getUrl();">Finish</a>
                            @endif
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 
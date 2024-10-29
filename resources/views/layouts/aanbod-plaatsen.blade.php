<!-- resources/views/layouts/aanbod-plaatsen.blade.php -->
@extends('layouts.app')

@section('content')
    <style>
        .centered {
            background-image: url('images/kentekenplaat.png');
            background-position: 5px center;
            background-repeat: no-repeat;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .kentekencheck-input #kenteken {
            text-align: center;
            font-size: 28px;
            width: 225px;
        }

        input[type=text] {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAvCAMAAADdAborAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAABCUExURSVX19fd9S1UsihUwSVUy////zNVpau57CRV1Edcg4N9SK+ZLGVrYHBwUvT2/VRicEVr232U49KwGZqMPNm1FcjQ8koJI5cAAACiSURBVCjPzZBJFsQgCEQrSFScMt//qq15rR1d9yIsfNSnQBT4X9hOWEhU4KaD4+CtHLqS6MAM8V+LlJZ7ipWS0Bmqk/ZYCrq1Wk351M8LS83Hh94FWOQHOBSL+oE7Jd8s5Jcy2jVQUysL57V0pFpxB8SRnG2aUsiPU8yPjTrx1phNPozBZCpI2wBMWnuA6RrAmrYeYEsDwDUPYE0ZzDle/D0fwJgE4zMjXtEAAAAASUVORK5CYII=) left no-repeat #ffce00;
            height: 50px;
            padding-left: 100px;
            width: 300px;
            border-radius: 5px;
            border: 0.5px solid black;
        }

        button {
            background-color: #ffce00;
            border: none;
            color: black;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            padding: 10px 24px;
        }
    </style>
    <div class="form-group mt-5 d-flex justify-content-center align-middle">
        <form action="{{ route('aanbod.submit') }}" method="POST">
            @csrf
            <div class="kenteken-holder">
                <div class="kenteken-input form-group">
                    <input type="text" id="license_plate" name="license_plate" class="form-control"
                        style="background-color: #ffce00" name="kenteken" placeholder="7-ZSB-84" required> <br>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

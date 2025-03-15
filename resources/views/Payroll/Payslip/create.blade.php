@extends('layouts.app')

@section('title', 'Payslips')

@section('content')

@livewire("payslip.create")

@endsection

@section("js")

<script>
    Livewire.on('payslip-already-exists', function () {
     Swal.fire({
         title: 'Payslip Already Exists',
         text: 'This Employee Has Already Generated A Payslip For This Month',
         icon: 'error',
         confirmButtonText: 'Okay',
         willOpen: () => {
            document.querySelectorAll('.swal2-container select').forEach(el => el.remove());
        }
     })
    });



    Livewire.on('payslip-created', function () {
     Swal.fire({
         title: 'Payslip Created',
         text: 'Payslip Has Been Created For The Selected Employee',
         icon: 'success',
         confirmButtonText: 'Okay',
         willOpen: () => {
            document.querySelectorAll('.swal2-container select').forEach(el => el.remove());
        }
     })
    });


    Livewire.on('payslip-error', function () {
     Swal.fire({
         title: 'Payslip Created',
         text: 'Error Occured While Creating Payslip',
         icon: 'error',
         confirmButtonText: 'Okay',
         willOpen: () => {
            document.querySelectorAll('.swal2-container select').forEach(el => el.remove());
        }
     })
    });
</script>


@endsection
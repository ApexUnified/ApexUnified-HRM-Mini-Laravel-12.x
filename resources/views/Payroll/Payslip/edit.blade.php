@extends('layouts.app')

@section('title', 'Payslips')

@section('content')

@livewire("payslip.edit",["payslip" => $payslip])

@endsection

@section("js")

<script>
     Livewire.on('payslip-updated', function () {
     Swal.fire({
         title: 'Payslip Updated',
         text: 'Payslip Has Been Updated Succesfully',
         icon: 'success',
         confirmButtonText: 'Okay',
         willOpen: () => {
            document.querySelectorAll('.swal2-container select').forEach(el => el.remove());
        }
     })
    });


    Livewire.on('payslip-updating-error', function () {
     Swal.fire({
         title: 'Payslip Updating Error',
         text: 'Error Occured While Updating Payslip',
         icon: 'error',
         confirmButtonText: 'Okay',
         willOpen: () => {
            document.querySelectorAll('.swal2-container select').forEach(el => el.remove());
        }
     });
    });
</script>

@endsection
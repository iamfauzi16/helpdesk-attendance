<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 14px;
      color: #191919;
    }
  </style>
</head>
<body style="background-color: #dfdfdf;">
  <table style="width:650px; background-color: white; border-radius: 16px; margin-top:24px; padding: 36px;" align="center">
    <tr align="center">
      <td>
        <a href="{{ route('home') }}">
          <img src="{{ asset('img/blibli.jpg') }}" width="300px" />

        </a>
      </td>
    </tr>
    <tr>
      <td>
        <p>Halo, <b>{{ Auth::user()->name }}</b>.</p>
        <p>Kode keamanan Anda: <b>{{ $otpToken }}</b>. Gunakan kode ini untuk verifikasi identitas Anda dan mengakses akun Anda dengan aman. </p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Jika kamu membutuhkan bantuan, silahkan hubungi IT Helpdesk </p>
        <p>Teams : it-helpdesk</p>
        <p>Email : it-helpdesk@gdn-commerce.com</p>
          
      </td>
    </tr>
  </table>
  <table style="width: 600px;" align="center">
    <tr>
      <td><p style="text-align: center; color: #5f5f5f">Gedung Sarana Jaya, Jl. Budi Kemuliaan No.I No.1, RT.2/RW.3, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110</p></td>
    </tr>
  </table>
</body>
</html>
@if(@Session('popup')['status']==null && Session('lang')=='jp')
<style>.swal2-header{margin-top:3em !important;}.swal2-title{font-size:4em !important;}</style>
<script>Swal.fire({title:'Coming Soon'});</script>
@endif
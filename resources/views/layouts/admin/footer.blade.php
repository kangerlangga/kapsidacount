<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            Copyright &copy; <?= date("Y")?> by <a href="{{  url('') }}" target="_blank">Kapsida Count</a>
        </div>
    </div>
</footer>
<form id="logout-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script>
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out from your account!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Logout!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-admin').submit();
        }
    });
}
</script>

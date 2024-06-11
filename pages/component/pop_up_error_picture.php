<!-- ERREUR POPUP -->
<div id="pop_up_container">
    <div class="pop_up_error">
        <button class="close_button" onclick="closePopup()"><i class='bx bxs-x-circle'></i></button>
        <h3>ERROR</h3>
        <span class="line_sep"></span>
        <div id="error_message">
        <p>Seulement les formats jpg, jpeg, gif, png en dessous de 10 Mo sont autorisés.</p>
        </div>
    </div>
</div>

<script>   

    function closePopup() {
        document.getElementById('pop_up_container').classList.add('close');
        window.location.href = '/pages/user_profile.php';
    }

</script>

<!-- ERREUR POPUP -->
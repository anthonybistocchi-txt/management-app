import $ from 'jquery'; 
import { Toast } from '../../components/swal';
import { AuthService } from "../../services/AuthService";

$(document).ready(() => {
    const $form             = $('#form-login');
    const $inputUsername    = $('#username'); 
    const $inputPassword    = $('#password'); 
    const $submitButton     = $('#submit-button');
    const $buttonVisibility = $('#button-visibility');

    $buttonVisibility.off('click').on('click', () => {
        console.log('Clicou no botão de visibilidade');
        
        const currentType = $inputPassword.attr('type');
        const newType     = currentType === 'password' ? 'text' : 'password';
        
        $inputPassword.attr('type', newType);
        
        $buttonVisibility.find('span').text(newType === 'password' ? 'visibility' : 'visibility_off');
    });

    $form.off('submit').on('submit', async function (e) {
        e.preventDefault();
        console.log('Tentando enviar o formulário de login');

        const usernameValue = $inputUsername.val() as string;
        const passwordValue = $inputPassword.val() as string;

        if (!usernameValue || !passwordValue) {
            Toast.error('Por favor, preencha todos os campos.');
            return;
        }

        const originalText = $submitButton.text();
        $submitButton.prop('disabled', true).html('<span class="material-symbols-outlined animate-spin text-sm mr-2">progress_activity</span> Entrando...');

        try {
            await AuthService.login({
                name: usernameValue, 
                password: passwordValue
            });
            
            Toast.success('Login realizado com sucesso!');

            setTimeout(() => {
                window.location.href = '/index/dashboard';
            }, 1500);

        } catch (error: any) {
            Toast.error(error.message);

            $submitButton.prop('disabled', false).text(originalText);
            $inputPassword.val('').trigger('focus');
        }
    });
});
import $ from 'jquery';
import { AuthService } from '../../services/Auth/AuthService';
import { Toast } from '../../components/Swal/swal';
import { AuthController } from '../../Controllers/Auth/Auth';


$(document).ready(() => {
    const $form = $('#form-login');
    const $inputUsername = $('#username');
    const $inputPassword = $('#password');
    const $submitButton = $('#submit-button');
    const $buttonVisibility = $('#button-visibility');


    $buttonVisibility.off('click').on('click', () => {

        const currentType = $inputPassword.attr('type');
        const newType = currentType === 'password' ? 'text' : 'password';

        $inputPassword.attr('type', newType);

        $buttonVisibility.find('span').text(newType === 'password' ? 'visibility' : 'visibility_off');
    });

    $form.off('submit').on('submit', async function (e) {
        e.preventDefault();

        const usernameValue = $inputUsername.val() as string;
        const passwordValue = $inputPassword.val() as string;

        if (!usernameValue || !passwordValue) {
            Toast.error('Por favor, preencha todos os campos.');
            return;
        }

        const originalText = $submitButton.text();
        $submitButton.prop('disabled', true).html('<span class="material-symbols-outlined animate-spin text-sm mr-2">progress_activity</span> Entrando...');

        const loginSuccess = await AuthController.login({
            username: usernameValue,
            password: passwordValue
        });

        if (!loginSuccess) {
            Toast.error('E-mail ou senha inválidos.');
            $submitButton.prop('disabled', false).text(originalText);

            $inputPassword.val('').trigger('focus');
            throw new Error('Login failed');
        }

        Toast.success('Login realizado com sucesso!');
        $submitButton.prop('disabled', false).text(originalText);

        setTimeout(() => {
            window.location.href = '/index/dashboard';
        }, 1500);
    });
});
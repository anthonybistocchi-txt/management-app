import $ from 'jquery';
import { Toast } from '../../components/Swal/swal';
import { AuthController } from '../../Controllers/Auth/AuthController';

$(document).ready(() => {
    const $form             = $('#form-login');
    const $inputUsername    = $('#username');
    const $inputPassword    = $('#password');
    const $submitButton     = $('#submit-button');
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

        const result = await AuthController.login({
            username: usernameValue,
            password: passwordValue,
        });

        if (!result.success) {
            Toast.error('E-mail ou senha inválidos.');
            $submitButton.prop('disabled', false).text(originalText);
            $inputPassword.val('').trigger('focus');
            return;
        }

        Toast.success('Login realizado com sucesso!');
        $submitButton.prop('disabled', false).text(originalText);

        setTimeout(() => {
            window.location.href = result.redirectUrl;
        }, 1500);
    });
});

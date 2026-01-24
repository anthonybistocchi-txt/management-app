import $ from 'jquery';
import { getUserLoggedController } from '../../../Controllers/User/getUserLogged';
import { DatePicker } from '../../../components/DatePicker/flatpickr';
import { openModal } from '../../../utils/openModal';
import { closeModal } from '../../../utils/CloseModal';
import { Toast } from '../../../components/Swal/swal';
import { maskCpf } from '../../../utils/cpfMask';

$(document).ready(() => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-role');

    const $btnOpenCreateUser  = $('#btn-open-create-user');
    const $inputSearchUser    = $('#input-search-user');
    const $selectFilterRole   = $('#select-filter-role');
    const $selectFilterStatus = $('#select-filter-status');

    const $btnPaginationPrev = $('#btn-pagination-prev');
    const $btnPaginationNext = $('#btn-pagination-next');

    const $modalCreateUser = $('#modal-create-user');
    
    const $btnModalClose       = $('#btn-modal-close');
    const $btnModalCancel      = $('#btn-modal-cancel');
    const $btnModalSave        = $('#btn-modal-save'); 
    const $inputCreateName     = $('#input-create-name');
    const $inputCreateUsername = $('#input-create-username');
    const $inputCreateEmail    = $('#input-create-email');
    const $selectCreateRole    = $('#select-create-role');
    const $inputCreatePassword = $('#input-create-password');
    const $inputCreateCpf      = $('#input-create-cpf');

    $inputCreateCpf.on('input', function() {
        const typedValue = $(this).val() as string;
        $(this).val(maskCpf(typedValue));
    });

    getUserLoggedController.loadUserLogged($textHeaderUsername, $textHeaderRole);

    $btnOpenCreateUser.on('click', () => {
        openModal($modalCreateUser);

        
        $btnModalSave.on('click', (e) => {
            e.preventDefault();

          
            const createNameValue     = String($inputCreateName.val())          as string;
            const createEmailValue    = String($inputCreateEmail.val())         as string;
            const createIdRoleValue   = Number($selectCreateRole.val()          as string);
            const createPasswordValue = String($inputCreatePassword.val())      as string;
            const createCpfValue      = String($inputCreateCpf.val())           as string;
            const createUsernameValue = String($inputCreateUsername.val())      as string;
            
            console.log(createNameValue, createEmailValue, createIdRoleValue, createPasswordValue, createCpfValue, createUsernameValue);


            if (!createNameValue || !createEmailValue || !createIdRoleValue || !createPasswordValue || !createCpfValue || !createUsernameValue) {
                Toast.info("Por favor, preencha todos os campos obrigatórios.");
                return;
            }

            if (createPasswordValue.length < 8) {
                Toast.info("A senha deve ter pelo menos 8 caracteres.");
                return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(createEmailValue)) {
                Toast.info("Por favor, insira um email válido.");
                return;
            }

            $btnModalSave.html('Salvando...').prop('disabled', true);

            // UserFormController.handleCreateUserSubmit(
            //     createNameValue,
            //     createUsernameValue,
            //     createEmailValue,
            //     createIdRoleValue,
            //     createPasswordValue,
            //     createCpfValue
            // );
                $btnModalSave.html('Salvar').prop('disabled', false);
        });
    });

    $btnModalClose.on('click', () => {
        closeModal($modalCreateUser);
    });

    $btnModalCancel.on('click', () => {
        closeModal($modalCreateUser);
    });

    
});
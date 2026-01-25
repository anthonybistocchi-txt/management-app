import $ from 'jquery';
import { getUserLoggedController } from '../../../Controllers/User/getUserLogged';
import { openModal } from '../../../utils/openModal';
import { closeModal } from '../../../utils/CloseModal';
import { Toast } from '../../../components/Swal/swal';
import { maskCpf } from '../../../utils/cpfMask';
import { modalCreateUser } from './modalCreateUser';
import { GetUserController } from '../../../Controllers/User/GetUsers';
import { loadTableUsers } from './tableUsers';

$(document).ready( async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderTypeUser = $('#text-header-type-user');

    const $btnOpenCreateUser    = $('#btn-open-create-user');
    const $btnSubmitSearchUser  = $('#btn-submit-search-user');
    const $inputSearchUser      = $('#input-search-user');
    const $selectFilterTypeUser = $('#select-filter-type-user');
    const $selectFilterStatus   = $('#select-filter-status');

    const $tableUsers        = $('#table-users');

    const $btnPaginationPrev = $('#btn-pagination-prev');
    const $btnPaginationNext = $('#btn-pagination-next');

    const $modalCreateUser      = $('#modal-create-user');
    const $btnModalClose        = $('#btn-modal-close');
    const $btnModalCancel       = $('#btn-modal-cancel');
    const $btnModalSave         = $('#btn-modal-save'); 
    const $inputCreateName      = $('#input-create-name');
    const $inputCreateUsername  = $('#input-create-username');
    const $inputCreateEmail     = $('#input-create-email');
    const $selectCreateTypeUser = $('#select-create-type-user');
    const $inputCreatePassword  = $('#input-create-password');
    const $inputCreateCpf       = $('#input-create-cpf');

    const users = await GetUserController.getUsers();
    loadTableUsers($tableUsers, users?.users);

    getUserLoggedController.loadUserLogged($textHeaderUsername, $textHeaderTypeUser);

    $btnOpenCreateUser.on('click', async () => {
        openModal($modalCreateUser);

        $inputCreateCpf.on('input', function() {
            const typedValue = $(this).val() as string;   // mask cpf
            $(this).val(maskCpf(typedValue));
        });

        $btnModalSave.on('click', async (e) => {
            e.preventDefault();

           const requestCreateUser = await modalCreateUser.handleCreateUserSubmit(
                $inputCreateName,
                $inputCreateEmail,
                $selectCreateTypeUser,
                $inputCreatePassword,
                $inputCreateCpf,
                $inputCreateUsername
            );
            
            $btnModalSave.html('Salvando...').prop('disabled', true);

            if (requestCreateUser) {
                Toast.success("Usuário criado com sucesso.");
                $btnModalSave.html('Salvar').prop('disabled', false);

                closeModal($modalCreateUser);
                loadTableUsers($tableUsers);

            } else {
                Toast.error("Erro ao criar usuário. Por favor, tente novamente.");
                $btnModalSave.html('Salvar').prop('disabled', false);
            }
        });
    });

    loadTableUsers($tableUsers);

    $btnSubmitSearchUser.on('click',async (e) => {
        e.preventDefault();
        

    });

    $btnModalClose.on('click', () => {
        closeModal($modalCreateUser);
    });

    $btnModalCancel.on('click', () => {
        closeModal($modalCreateUser);
    });

    
});
import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import { DatePicker } from '../../components/DatePicker/flatpickr';
import { showUserLogged } from '../../components/User/ShowUserLogged';
import { showGrapics } from '../../components/graphicDashboard/ShowGrapics';

$(document).ready(async () => {
    const $username          = $('#user_name');
    const $typeUserId        = $('#type_user_id');
    const $totalSales        = $('#total_sales');
    const $topSellingProduct = $('#top_selling_product');
    const $datePickerId      = $("#date_range_picker"); 
    const $btn_submit        = $("#btn_submit");
    const originalText       = $btn_submit.html();

    await showUserLogged($username, $typeUserId);

    let startFilter: string;
    let endFilter:   string;

    DatePicker.initRange($datePickerId, (start, end) => {
        startFilter = start;
        endFilter   = end;
    });

    $btn_submit.on('click', async function(e) {
        e.preventDefault();

        $btn_submit.html('Buscando...').prop('disabled', true);
        await showGrapics(
            startFilter, 
            endFilter, 
            $totalSales, 
            $topSellingProduct, 
            $btn_submit
        );

        $btn_submit.html('Buscar').prop('disabled', false);
    });

    $btn_submit.trigger('click')
    
});
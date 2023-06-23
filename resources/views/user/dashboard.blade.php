@extends('layouts.main')
@section('content')
    <form method="post" id="form">
        <input type="hidden" id="hidden_id" name="hidden_id">
        <div class="row">
            <div class="col">
                <label for="first_name" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="50"
                       minlength="2">
            </div>
            <div class="col">
                <label for="last_name" class="form-label">Consumption Period (Hour)</label>
                <input type="number" class="form-control" id="consumption_period" name="consumption_period" required >
            </div>

            <div class="col">
                <label for="last_name" class="form-label">Treatment Duration (Days)</label>
                <input type="number" class="form-control" id="treatment_duration" name="treatment_duration" required >
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="last_name" class="form-label">Start Date (Date)</label>
                <input type="text" class="form-control" id="treatment_start_date" name="treatment_start_date" required >
            </div>
            <div class="col">
                <label for="last_name" class="form-label">Start Time (HH:mm Format)</label>
                <input type="text" class="form-control" id="treatment_start_time" name="treatment_start_time" required >
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="btn-register">Register</button>
    </form>

    <hr/>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Start Time</td>
                <td>Consumption Period</td>
                <td>Treatment Duration</td>
                <td>Next Remind Time</td>
                <td></td>
            </tr>
        </table>
    </div>
@endsection
@push('scripts')
<script>
    let base_url = '<?= url('/api')  ?>';
    let itemCount = 1;
    let allItems = [];
    let token = localStorage.getItem("token");
    function deleteItem(id) {
        let c = confirm('Are You Sure ? ');
        if(c) {
            var settings = {
                "url": base_url + "/pill/delete/" + id,
                "method": "DELETE",
                "timeout": 0,
                "headers": {
                    "Authorization": "Bearer " + token
                },
            };
            $.ajax(settings).done(function (response) {
                readAllItems();
            });
        }
    }
    $(document).ready(function () {
        $.fn.datepicker.defaults.format = "yyyy/mm/dd";

        $('#treatment_start_date').datepicker({
            uiLibrary: 'bootstrap5'
        });
        readAllItems();
        function emptyForm() {
            $('#title').val('');
            $('#consumption_period').val('');
            $('#treatment_start_time').val('');
            $('#treatment_duration').val('');
        }
        function fillData() {
            $('.table').html('');
            let header = '<tr>\n' +
                '                <td>#</td>\n' +
                '                <td>Title</td>\n' +
                '                <td>Start Time</td>\n' +
                '                <td>Consumption Period</td>\n' +
                '                <td>Treatment Duration</td>\n' +
                '                <td>Next Remind Time</td>\n' +
                '                <td></td>\n' +
                '            </tr>';
            $('.table').append(header);
            allItems.forEach((element) => {
                let id = element.id;
                let title = element.title;
                let consumption_period = element.consumption_period;
                let treatment_start_time = element.treatment_start_time;
                let treatment_duration = element.treatment_duration;
                let next_remind_time = element.next_remind_time;
                let item = {
                    id,
                    title,
                    consumption_period,
                    treatment_start_time,
                    treatment_duration,
                    next_remind_time,
                };
                console.log(item);
                let text = '<tr data-id="' + id + '" >' +
                    '<td>' + itemCount + '</td>' +
                    '<td>' + title + '</td>' +
                    '<td>' + treatment_start_time + '</td>' +
                    '<td>' + consumption_period + '</td>' +
                    '<td>' + treatment_duration + '</td>' +
                    '<td>' + next_remind_time + '</td>' +
                    '<td>' +
                    ' <a href="#" class="fa fa-delete" onclick="deleteItem(' + id + ')">remove</a>' +
                    '</td>' +
                    '</tr>';
                $('.table').append(text);
            });

        }
        function readAllItems() {
            var settings = {
                "url":  base_url + "/pill",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Authorization": "Bearer " + token
                },
            };

            $.ajax(settings).done(function (response) {
                allItems = response.data;
                fillData();
            });

        }
        $("#btn-register").on("click", function (event) {
            let title = $('#title').val();
            let treatment_start_date = $('#treatment_start_date').val();
            let treatment_start_time = $('#treatment_start_time').val();
            let consumption_period = $('#consumption_period').val();
            let treatment_duration = $('#treatment_duration').val();
            var settings = {
                "url":  base_url + "/pill",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Authorization": "Bearer " + token
                },
                data:{
                    title,
                    treatment_start_date,
                    treatment_start_time,
                    consumption_period,
                    treatment_duration,
                }
            };

            $.ajax(settings).done(function (response) {
                console.log("Success!");
                console.log(response);
                emptyForm();
                readAllItems();
            });
            event.preventDefault();
        });


    });

</script>
@endpush

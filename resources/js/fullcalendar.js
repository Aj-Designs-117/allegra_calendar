document.addEventListener("DOMContentLoaded", function () {
    let calendarEl = document.getElementById("calendar");
    let globalUrl = urlGlobal;

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "timeGridListDay",
        locale: "es",
        timeZone: "locale",
        allDaySlot: false,
        selectable: true,
        themeSystem: 'bootstrap5',
        headerToolbar: {
        left: "prev,next today",
        right: "timeGridDay,listWeek,timeGridListDay",
    },
        views: {
        timeGridListDay: {
            type: 'listWeek',
            duration: { days: 1 },
            buttonText: 'hoy'
        }
    },
        events: `${globalUrl}/show`,
        eventClick: function (info) {
            $("#event").modal("show");
            idEvent = info.event.id;
            $.ajax({
                type: "GET",
                url: "/event/show/" + info.event.id,
                success: function (data) {
                    $("#eventDate").val(info.event.start.toISOString().slice(0, 10));
                    $("#eventTime").val(data.time);
                    $("#eventTitle").val(data.title);
                    $("#eventQuota").val(data.limited_quotas);
                },
                error: function (error) {
                    if (error.responseJSON) {
                        console.log(error.responseJSON);
                    }
                },
            });
        },
    });
calendar.render();
});

$(document).ready(function () {
    toastr.options = {
        positionClass: "toast-top-right",
        showDuration: "500",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
});
let idEvent = 0;

function listAppointments() {
    $.ajax({
        type: "GET",
        url: "/agenda/list",
        success: function (data) {
            $("#tableListAppointments tbody").empty();

            $.each(data, function (index, appointment) {
                $("#tableListAppointments tbody").append(
                    `<tr>
              <td><small>${appointment.title}</small></td>
              <td><small>${appointment.date}</small></td>
              <td><small>${appointment.time}</small></td>
              <td><button type="submit" class="btn btn-danger btn-sm destroyAppointment" data-appointment-id="${appointment.id}/${appointment.event_id}/${appointment.user_id}"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
            `
                );
            });
        },
        error: function (error) {
            console.log(xhr.responseJSON.error);
        },
    });
}

function saveAppointments() {
    let id = idEvent;
    let title = $("#eventTitle").val();
    let date = $("#eventDate").val();
    let time = $("#eventTime").val();

    $.ajax({
        url: "store",
        method: "POST",
        data: {
            id: id,
            title: title,
            date: date,
            time: time,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            $("#event").modal("hide");
            listAppointments();
            if (data.success) {
                toastr.success(data.success);
            } else if (data.warning) {
                toastr.warning(data.warning);
            } else {
                toastr.error(data.error);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseJSON.error);
        },
    });
}

function destroy(appointmentId) {
    console.log(appointmentId);
    $.ajax({
        url: "remove/" + appointmentId,
        type: "GET",
        success: function (data) {
            listAppointments();
            if (data.success) {
                toastr.success(data.success);
            } else {
                toastr.error(data.error);
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

$(document).ready(function () {
    listAppointments();

    $("#Appointmentform").submit(function (e) {
        e.preventDefault();
        saveAppointments();
    });

    $("#tableListAppointments").on("click", ".destroyAppointment", function () {
        var appointmentId = $(this).data("appointment-id");
        destroy(appointmentId);
    });
});

const openDatePicker = () => {
    const datePickerElement = document.getElementById(`datepicker`);

    datePickerElement.showPicker();
};

const getEvents = ({ value }) => {
    const url = `/jadwal/${value}`;

    $.ajax({
        url,
        success: (result) => {
            const wrapper = document.getElementById("event-list");

            if (result.success && result.data.length) {
                wrapper.innerHTML = `<h6 class='mb-2'>List Acara pada Tanggal ${getFormattedDate(
                    value
                )}</h6>`;

                result.data.forEach((data) => {
                    wrapper.innerHTML += `
                      <a href='/gallery/${data.event.slug}' class='event-data'>
                        <div class="card w-100 my-2 card-hover-shadow">
                          <div class="card-body row">
                            <div class="col-12 d-flex gap-2 align-items-center">
                              <div>
                                <h5 class="card-title mb-0 h5">${data.event.title}</h5>
                                <h6 class="mt-2 text-dark font-weight-light">${data.venue ? data.venue.name : 'Not Include Venue'}</h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    `;
                });
            } else {
                wrapper.innerHTML = `<p class='mb-2 text-center text-muted'>Belum ada Event pada Tanggal ${value}</p>`;
            }
        },
    });
};

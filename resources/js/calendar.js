document.addEventListener('DOMContentLoaded', () => {
  const monthYear = document.getElementById('monthYear');
  const calendarGrid = document.getElementById('calendarGrid');
  const prevMonthBtn = document.getElementById('prevMonth');
  const nextMonthBtn = document.getElementById('nextMonth');
  const closeModalBtn = document.getElementById('closeModal');

  let currentDate = new Date();

  function renderCalendar(year, month) {
    const calendarGrid = document.getElementById('calendarGrid');
    calendarGrid.innerHTML = '';

    const firstDayOfMonth = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0);
    const startDayOfWeek = firstDayOfMonth.getDay();

    const today = new Date();
    const totalDays = lastDayOfMonth.getDate();

    let date = 1;
    for (let i = 0; i < 6 * 7; i++) {
        const dayCell = document.createElement('div');
        dayCell.classList.add('day', 'w-10', 'h-10', 'flex', 'items-center', 'justify-center', 'rounded-full', 'cursor-pointer', 'hover:bg-[#D5BEBE]');

        if (i >= startDayOfWeek && date <= totalDays) {
            const displayDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
            dayCell.textContent = date;
            dayCell.setAttribute('data-date', displayDate);

            const isToday = (
                today.getFullYear() === year &&
                today.getMonth() === month &&
                today.getDate() === date
            );
            if (isToday) {
                dayCell.classList.add('bg-[#AB7C7C]', 'text-white', 'font-semibold');
            }

            const foundPeriod = periodDates.find(p => {
                const periodDate = new Date(p.date).toISOString().slice(0, 10);
                return periodDate === displayDate;
            });

            if (foundPeriod) {
                const strokeColor = foundPeriod.jenis === 'haid' ? '#d96e94'
                                : foundPeriod.jenis === 'istihadhah' ? '#4DA8DA'
                                : '#abe9b4';
                dayCell.style.border = `2px dashed ${strokeColor}`;dayCell.setAttribute('data-has-record', 'true');
                dayCell.setAttribute('data-id', foundPeriod.id);
            } else {
                dayCell.setAttribute('data-has-record', 'false');
            }


            dayCell.addEventListener('click', () => {
                const hasRecord = dayCell.dataset.hasRecord === "true";
                const displayDate = dayCell.getAttribute('data-date');
                const recordData = periodDates.find(p => {
                const formattedDate = new Date(p.date).toISOString().slice(0, 10);
                return formattedDate === displayDate;
            });

                const form = document.getElementById('recordForm');
                const title = document.getElementById('modalTitle');
                const submitBtn = document.getElementById('submitBtn');
                const deleteBtn = document.getElementById('deleteBtn');
                const methodField = document.getElementById('formMethod');
                const dateDisplay = document.getElementById('selectedDateDisplay');

                document.getElementById('recordDateModal').value = displayDate;
                dateDisplay.textContent = displayDate;

                if (recordData) {
                    form.action = document.querySelector('meta[name="route-destroy"]').content;
                    methodField.value = 'PUT';
                    title.textContent = "Edit Period";
                    submitBtn.textContent = "Update"
                    deleteBtn.classList.remove('hidden');

                    deleteBtn.onclick = () => {
                        if (confirm("Apakah anda yakin menghapus data ini? Penghapusan ini akan mempengaruhi hasil prediksi anda.")) {
                            form.action = document.querySelector('meta[name="route-destroy"]').content;
                            document.getElementById('periodIdField').value = recordData.id;
                            methodField.value = 'DELETE';
                            form.submit();
                        }
                    };
                    document.getElementById('waktu_keluar').value = recordData.waktu_keluar
                        ? new Date(recordData.waktu_keluar).toTimeString().slice(0,5)
                        : '';
                    document.getElementById('is_fullday').checked = recordData.is_fullday == 1;
                    document.getElementById('warna').value = recordData.warna ?? '';
                }
                else{
                    form.action = document.querySelector('meta[name="route-store"]').content;
                    methodField.value = 'POST';
                    title.textContent = "Catat Period";
                    document.getElementById('recordDateModal').value = displayDate;
                    const matchingPeriod = periodDates.find(p => {
                            const formattedDate = new Date(p.date).toISOString().slice(0, 10);
                            return formattedDate === displayDate;
                        });
                    document.getElementById('periodIdField').value = matchingPeriod?.id ?? '';
                    submitBtn.textContent = "Simpan";
                    deleteBtn.classList.add('hidden');

                    document.getElementById('waktu_keluar').value = "";
                    document.getElementById('is_fullday').checked = false;
                    document.getElementById('warna').value = "";
                }

                window.dispatchEvent(new CustomEvent('open-modal', {detail: 'RecordModal'}
                ));
                window.addEventListener('open-modal', (e) => {
                console.log("Membuka modal:", e.detail);
                });
            });
            date++;
        }
        calendarGrid.appendChild(dayCell);
        }
    }

  function isToday(year, month, day) {
    const today = new Date();
    return (
      year === today.getFullYear() &&
      month === today.getMonth() &&
      day === today.getDate()
    );
  }

  if (prevMonthBtn && nextMonthBtn) {
    prevMonthBtn.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar(currentDate.getFullYear(), currentDate.getMonth());;
    });

    nextMonthBtn.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar(currentDate.getFullYear(), currentDate.getMonth());;
    });
  }

  renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
});


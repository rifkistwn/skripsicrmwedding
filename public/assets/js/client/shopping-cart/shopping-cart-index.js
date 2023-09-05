const openDatePicker = (index) => {
  const datePickerElement = document.getElementById(`datepicker-${index}`)

  datePickerElement.showPicker()
}

const changeDisplayDate = async ({ value }, index) => {
  const availability = await checkAvailabilityDate(value)

  if(availability) {
    const displayDateElement = document.querySelector(`input[name=display-date-input-${index}]`)
  
    displayDateElement.value = new Date(value).toLocaleDateString('id-ID', { day: 'numeric', month: "short", year: 'numeric' })
  
    addInputElement('datetime', value, index)
  } else {
    toastr.error('Mohon maaf, tanggal tersebut tidak tersedia. Harap pilih tanggal lain')
  }
}

const numberWithCommas = (number) => {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

// start::add and remove cart
const totalTextElement = document.getElementById('total-price-text')
const totalPriceElementInput = document.getElementById('price')

const sumPriceTotal = (element) => {
  const { checked } = element

  const price = element.dataset.price
  const packet_id = element.dataset.packet_id
  const venue_id = element.dataset.venue_id
  const promo_id = element.dataset.promo_id
  const index = element.dataset.index
  const cart_id = element.dataset.id

  if(checked) addData(price, packet_id, venue_id, promo_id, index, cart_id)
  else removeData(price, index)

  totalTextElement.innerHTML = `Rp. ${numberWithCommas(totalPriceElementInput.value)},-`
}

const addData = (price, packet_id, venue_id, promo_id, index, cart_id) => {
  totalPriceElementInput.value = parseInt(totalPriceElementInput.value || 0) + parseInt(price)

  addInputElement('packet_id', packet_id, index)
  addInputElement('venue_id', venue_id, index)
  addInputElement('promo_id', promo_id, index)
  addInputElement('price', price, index)
  addInputElement('id', cart_id, index)
}

const removeData = (price, index) => {
  totalPriceElementInput.value = parseInt(totalPriceElementInput.value) - parseInt(price)

  removeInputElement('packet_id', index)
  removeInputElement('venue_id', index)
  removeInputElement('promo_id', index)
  removeInputElement('price', index)
  removeInputElement('id', index)
}

const addInputElement = (name, value, index) => {
  const isExist = document.querySelector(`input[name='${name}[]'][data-index='${index}']`)
  
  if(!isExist) {
    let input = document.createElement("input")
  
    input.type = 'hidden'
    input.name = `${name}[${index}]`
    input.value = value
    input.dataset.index = index
  
    const cartInputWrapper = document.getElementById('cart-input')
  
    cartInputWrapper.appendChild(input)
  } else {
    isExist.value = value
  }
}

const removeInputElement = (name, index) => {
  let input = document.querySelector(`input[name='${name}[${index}]'][data-index='${index}']`)

  if(input) input.remove()
}
// end::add and remove cart

// start::check availability date
const checkAvailabilityDate = async (datetime) => {
  const url = `/check_date_availability`

  return await new Promise(resolve => {
    $.ajax({
      url,
      data: { datetime },
      dataType: "json",
      success: result => {
        if(result.success) resolve(result.data.availability)

        resolve(false)
      },
      error: function (request, status, error) {
        toastr.error(request.responseText)

        resolve(false)
      }
    })
  })
}
// end::check availability date
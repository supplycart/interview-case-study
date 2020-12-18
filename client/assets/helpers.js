
import Swal from 'sweetalert2'

export const Toast = Swal.mixin({
	toast: true,
	position: 'top-right',
	showConfirmButton: false,
	timer: 10000,
	width: '150%',
	padding: '20px',
	background: '#ffffff'
})





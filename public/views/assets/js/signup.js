const login = document.querySelector('.login');
const signup = document.querySelector('.signup');
const formLogin = document.querySelector('.login-form');
const formSignup = document.querySelector('.signup-form');

function loginForm() {
	login.classList.add('active');
	login.classList.remove('inactive');
	signup.classList.add('inactive');
	signup.classList.remove('active');
	formLogin.classList.remove('hide');
	formSignup.classList.add('hide');
}

function signupForm() {
	login.classList.add('inactive');
	login.classList.remove('active');
	signup.classList.add('active');
	signup.classList.remove('inactive');
	formLogin.classList.add('hide');
	formSignup.classList.remove('hide');
}

login.addEventListener('click', loginForm);
signup.addEventListener('click', signupForm);

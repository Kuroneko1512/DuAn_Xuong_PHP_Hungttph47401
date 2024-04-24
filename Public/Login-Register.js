document.addEventListener('DOMContentLoaded', function() {

    const byId = (id) => {
        return document.getElementById(id);
    };
    const $signUpButton = byId('signUp');
    const $signInButton = byId('signIn');
    const $container = byId('log-sign');
    // console.log($signInButton);
    // console.log('11');
    // console.log($container);
    // console.log('111');
    // console.log($signUpButton);
    // console.log('1111');
    $signUpButton.addEventListener('click', () => {
        $container.classList.add('right-panel-active');
        // console.log($container);
    });

    $signInButton.addEventListener('click', () => {
        $container.classList.remove('right-panel-active');
    });
});
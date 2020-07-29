
if (window.Culqi) {
    Culqi.publicKey = process.env.MIX_CULQI_PUBLIC_KEY;
    Culqi.init();
}



window.culqi = () => {
    if (Culqi.token) {
        const form = document.getElementById('checkout__form');
        document.getElementById('culqi_token').value = Culqi.token.id;
        document.getElementById('culqi_email').value = Culqi.token.email;
        form.submit();
    } else {
        console.log(Culqi.error);
    }
};

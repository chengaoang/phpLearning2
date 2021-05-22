function login() {
    let loginForm = document.querySelector("#loginForm");
    let url = loginForm.getAttribute('action');
    loginForm.onsubmit = async (e) => {
        e.preventDefault();
        let response = await fetch(url, {
            method: 'POST',
            body: new FormData(loginForm)
        });
        let result = await response.json();
        if (result.code === 0){ // 失败
            let div = document.createElement('div');
            div.className = "alert";
            div.innerHTML = "<div class=\"alert alert-danger d-flex align-items-center btn-lg\" role=\"alert\">\n" +
                "    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>\n" +
                "    <div>\n" + result.msg +
                "    </div>\n" +
                "</div>";
            document.body.prepend(div);
            setTimeout(()=>{
                div.remove();
            },2000);
            console.log(result.msg);
            let captcha = document.querySelector("#captcha > img")
            captcha.click();
        }else{
            let div = document.createElement('div');
            div.className = "alert";
            div.innerHTML = "<div class=\"alert alert-success d-flex align-items-center btn-lg\" role=\"alert\">\n" +
                "    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>\n" +
                "    <div>\n" + result.msg +
                "    </div>\n" +
                "</div>";
            document.body.prepend(div);
            setTimeout(()=>{
                div.remove();
                location.href = '/admin/index/index';
            },1000);
            console.log(result.msg);
        }
    };
}

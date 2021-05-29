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
function myAlert(msg) {
    let div = document.createElement('div');
    div.className = "alert";
    div.innerHTML = "<div class=\"alert alert-danger d-flex align-items-center btn-lg\" role=\"alert\">\n" +
        "    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>\n" +
        "    <div>\n" + msg +
        "    </div>\n" +
        "</div>";
    document.body.prepend(div);
    setTimeout(()=>{
        div.remove();
    },2000);
    // console.log(msg);
}

function addBtnHandle() {
    // 点击addBtn添加栏目，移除hiddenRow的hidden
    let addBtn = document.getElementById('addBtn');
    let hiddenRow = document.getElementById('hiddenRow');
    addBtn.onclick = function () {
        hiddenRow.removeAttribute('hidden');
        hiddenRow.id = 'ROW';
        addBtn.style.display = 'none';
    }
}

function saveBtnHandle(newUrl, mainContent) {
    // 处理栏目页面的“保存修改按钮”的点击事件
    let saveBtn = document.getElementById('saveBtn');
    saveBtn.onclick = async function () {
        // fetch post json 给 php，$_POST=空 的问题
        // 参考：https://blog.csdn.net/qq_41293288/article/details/107211298
        let rows = document.querySelectorAll('#ROW');
        let categoryArr = [];
        for (let row of rows) {
            let category = [];
            let id = row.querySelector('#ID');
            id = id ? id.textContent : null;
            let name = row.querySelector('#name').value;
            let sort = row.querySelector('#sort').textContent;
            category.push(id, name.replace(/^\s*|\s*$/g,""), sort);
            categoryArr.push(category);
            // console.log(id+','+name.replace(/^\s*|\s*$/g,"")+','+sort);
        }
        for (let i = 0; i < categoryArr.length; i++) {
            if (categoryArr[i][0] == null){
                let saveState = await fetch('/admin/Category/save', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'name='+categoryArr[i][1]+' & sort='+categoryArr[i][2]
                });
                saveState.json().then((result)=>{
                    myAlert(result.msg);
                });
            }else{
                let saveState = await fetch('/admin/Category/save', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id='+categoryArr[i][0]+' & name='+categoryArr[i][1]+' & sort='+categoryArr[i][2]
                });
                saveState.json().then((result)=>{
                    myAlert(result.msg);
                });
            }
        }
        //----------------保存后重新fetch栏目管理页面，innerHtml---------------
        let response = await fetch(newUrl,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        if (response.ok) { // 如果 HTTP 状态码为 200-299
            // 获取 response body
            mainContent.innerHTML = await response.text();
            //重新绑定addBtn
            addBtnHandle();
            saveBtnHandle(newUrl, mainContent);
            deleteHandle(newUrl, mainContent);
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }
}

function ajaxInnerHTML() {
    // 点击添加栏目
    let category = document.getElementById('category');
    let article = document.getElementById('article');
    let mainContent = document.getElementById('main-content');
    category.onclick = function (ev) {
        categoryAjax(category.getAttribute('href'));
        return false;
    }
    async function categoryAjax(url) {
        window.history.pushState(null, null, url);
        let newUrl = window.location.href;
        let response = await fetch(newUrl,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        if (response.ok) { // 如果 HTTP 状态码为 200-299
            // 获取 response body
            mainContent.innerHTML = await response.text();
            addBtnHandle();
            saveBtnHandle(newUrl, mainContent);
            deleteHandle(newUrl, mainContent);
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }
    article.onclick = function (){
        articleAjax(article.getAttribute('href'));
        active();
        return false;
    }
    async function articleAjax(url) {
        window.history.pushState(null, null, url);
        let newUrl = window.location.href;
        let response = await fetch(newUrl,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        if (response.ok) { // 如果 HTTP 状态码为 200-299
            // 获取 response body
            mainContent.innerHTML = await response.text();
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }

}
function deleteHandle(url, mainContent) {
    let delBatons = document.querySelectorAll('#del');
    for (let elem of delBatons){
        let href = elem.getAttribute('href');
        elem.onclick =  async () => {
            await foo();
        }
        async function foo() {
            console.log("foor running");
            let delResponse = (await fetch(href,{
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })).json();
            delResponse.then((result) => {
                myAlert(result.msg); // 删除后弹提示信息
            })
            // 重新加载main-content
            let response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (response.ok) { // 如果 HTTP 状态码为 200-299
                // 获取 response body
                mainContent.innerHTML = await response.text();
                deleteHandle(url, mainContent);
            } else {
                alert("HTTP-Error: " + response.status);
            }
            //
            addBtnHandle();
            saveBtnHandle(url, mainContent);
        }
    }
}
async function init() {
    let mainContent = document.getElementById('main-content');
    let url = window.location.href;
    let response = await fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    if (response.ok) { // 如果 HTTP 状态码为 200-299
        // 获取 response body
        mainContent.innerHTML = await response.text();
    } else {
        alert("HTTP-Error: " + response.status);
    }
    // 非ajax（浏览器直接http://www.phplearning2.com/admin/category/index）
    // 添加 保存 删除 的事件都不会被绑定，只有点击了侧边栏三个任意一个才会绑定事件
    if (window.location.pathname.match('/[^/]*/([^/]*)/')[1] === 'category'){
        addBtnHandle();
        saveBtnHandle(window.location.href, document.querySelector('#main-content'));
        deleteHandle(window.location.href, document.querySelector('#main-content'));
    }
}

function active(){
    // saveBtnHandle(newUrl, mainContent);
    // deleteHandle(newUrl, mainContent);
    let index = document.querySelector('#index');
    let category = document.querySelector('#category');
    let article = document.querySelector('#article');
    let url = window.location.pathname.match('/[^/]*/([^/]*)/')[1];
    switch (url) {
        case 'index':
            index.classList.add('active');
            category.classList.remove('active');
            article.classList.remove('active');
            return;
        case 'category':
            category.classList.add('active');
            index.classList.remove('active');
            article.classList.remove('active');
            return;
        case 'article':
            article.classList.add('active');
            index.classList.remove('active');
            category.classList.remove('active');
            return;
    }
}

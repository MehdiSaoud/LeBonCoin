let responseBtn = document.getElementsByClassName('response-btn');

for(let i =0; i<responseBtn.length; i++){
    responseBtn[i].addEventListener('click', (e) => {
        e.preventDefault();
        const comment = responseBtn[i].parentNode.querySelector('.comment');
        const formContainer = document.createElement('div');
        formContainer.classList.add("response-form");
        formContainer.innerHTML=`
            <label for="response">Réponse</label>
            <textarea id="response" name="response" rows="3"></textarea>
            <button class="btn btn-lg btn-primary w-25" type="submit">
                Répondre
            </button>`
        comment.after(formContainer);
        responseBtn[i].style.display="none";
    });
}

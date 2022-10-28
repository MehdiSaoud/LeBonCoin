let responseBtn = document.getElementsByClassName('response-btn');

for(let i =0; i<responseBtn.length; i++){
    responseBtn[i].addEventListener('click', (e) => {
        e.preventDefault();
        const comment = responseBtn[i].parentNode.querySelector('.comment');
        const formContainer = document.createElement('div');
        formContainer.classList.add("response-form");
        formContainer.innerHTML=`
            <label for="response">Réponse</label>
            <div class="d-flex">
                <textarea class="comment-text" id="response" name="response" rows="2" placeholder="Votre réponse..."></textarea>
                <button class="submit-comment" type="submit">
                    Répondre
                </button>
            </div>`
        comment.after(formContainer);
        responseBtn[i].style.display="none";
    });
}

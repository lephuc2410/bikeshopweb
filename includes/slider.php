<div class="slider">
        <div class="aspect-ratio-169">
            <img src="images/poster/poster1.jpg" alt="">
            <img src="images/poster/poster2.jpg" alt="">
            <img src="images/poster/poster3.jpg" alt="">
            <img src="images/poster/poster4.jpg" alt="">
        </div>
        <div class="dot-container">
            <div class="dot dot-active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
</div>
<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector('.aspect-ratio-169')
    const dotItem = document.querySelectorAll(".dot")
    let index = 0;
    let imgNumber = imgPosition.length;
    console.log(imgNumber)
    imgPosition.forEach(function(image,index){
        image.style.left = index*100 + "%"
        dotItem[index].addEventListener("click",function(){
            imgContainer.style.left = "-" + index*100 + "%"
            const dotActive = document.querySelector('.dot-active')
            dotActive.classList.remove('dot-active')
            dotItem[index].classList.add('dot-active')
        })
    })
    function imgSlide(){
        index++;
        console.log(index)
        if (index>=imgNumber){index=0}
        imgContainer.style.left = "-" + index*100 + "%"
    }
    setInterval(imgSlide,5000)
</script>
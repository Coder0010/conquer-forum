<style>
    .loading_container{
        background-color: rgba(0, 0, 0, 0.0);
        position: fixed;
        perspective: 600px;
        z-index: 9999;
        width: 100%;
        height: 100%;
        transition: all 1s ease-in-out;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .shape_2{
        width: 100px;
        height: 100px;
        border: 1px solid #000;
        transform: rotateZ(45deg);
        display: flex;
        flex-wrap: wrap;
    }
    .shape_2 span{
        width: 50%;
        height: 50%;
        backface-visibility: hidden;
        background-color: #f7600e;
    }
    .shape_2 span:first-child {animation: shape_2_flip_1 2s infinite ease-in-out alternate}
    .shape_2 span:nth-child(3){animation: shape_2_flip_2 2s .6s infinite ease-in-out alternate}
    .shape_2 span:last-child  {animation: shape_2_flip_3 2s 1.1s infinite ease-in-out alternate}
    .shape_2 span:nth-child(2){animation: shape_2_flip_4 2s 1.6s infinite ease-in-out alternate}

    @keyframes shape_2_flip_1{
        0%  {transform: rotateX(0deg); transform-origin: center}
        100%{transform: rotateX(180deg); transform-origin: bottom}
    }
    @keyframes shape_2_flip_2{
        0%  {transform: rotateY(0deg); transform-origin: center}
        100%{transform: rotateY(180deg); transform-origin: right}
    }
    @keyframes shape_2_flip_3{
        0%  {transform: rotateX(0deg); transform-origin: center}
        100%{transform: rotateX(180deg); transform-origin: top}
    }
    @keyframes shape_2_flip_4{
        0%  {transform: rotateY(0deg); transform-origin: center}
        100%{transform: rotateY(180deg); transform-origin: left}
    }
</style>

<section class="loading_container">
    <div class="shape_2">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</section>

<script>
    window.addEventListener('load', (event) => {
        $(".loading_container , .shape_2").animate({
            opacity: '0.5',
            height: '0',
            width: '0',
            bottom: '0',
            right: '0',
        });
    });
</script>

function getTemplateSlider(obj) {
  const data = obj.data;
  let template = {
    general_img: `
<div class="slider-main slider-main-img" style="background-image: url(${data.img});">
   <div class="slider-main-overlay"></div>
   <div class="slider-main-relative">
      <div class="slider-main-padding">
         <h1 class="slider-main-h1">${data.title}</h1>
         <p class="slider-main-p">${data.description}</p>
         <figure align="center">
            <div style="text-align: center;">
               <img width="380" height="114" src="${data.img_desc}" >
            </div>
         </figure>
      </div>
   </div>
</div>
      `,
      general: `
      <div class="slider-main slider-main-img" style="background-image: url(${data.img});">
      <div class="slider-main-overlay"></div>
      <div class="slider-main-relative">
         <div class="slider-main-padding">
            <h1 class="slider-main-h1">${data.title}</h1>
            <p class="slider-main-p">${data.description}</p>           
         </div>
      </div>
   </div>
            `,
      general_without_img: `
      <div class="slider-main slider-main-img" style="background-image: url(${data.img});">
         <div class="slider-main-overlay"></div>
         <div class="slider-main-relative">
            <div class="slider-main-padding">
               <h1 class="slider-main-h1">${data.title}</h1>
               <p class="slider-main-p">${data.description}</p>
            </div>
         </div>
      </div>
            `,
  };
  return template[obj.template];
}

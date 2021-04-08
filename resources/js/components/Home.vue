<template>
    <div>

    <div class="quiz-container" :set="increamentI = 0">
        <h4>Welcome to Quiz</h4>
        <div class="quiz-drag-area-box" v-for="SelectFrame in totalSelectFrame" >
            <div class="list-quiz-left">
                <div class="quiz-drag-area drag-area-left">
                    <h6>All Collections</h6>
                    <ul class="list-group" :id="'allcollection' + increamentI" v-if="show">
                        <li class="list-group-item" v-for="frame in frames" v-bind:key="frame.id"  @drop="drop1(frame.title,frame.id,'1','',frame.image.src,SelectFrame.id)">
                            <a href="javascript:void(0);">
                                {{frame.title}}
                            </a>
                        </li>
                    </ul>
                    <ul class="list-group" :id="'allcollection' + increamentI" v-else>
                        
                        <div v-for="(frame,key,index) in frames">
                            <div  v-for="color in selectedColor" >

                            <div v-if="color != frame.id">
                               
                                <p  v-bind:style="{ 'display': 'none' }">{{ li_f = true }}</p>
                            </div>
                            <div v-else>
                                <p  v-bind:style="{ 'display': 'none' }">{{ li_f = false }}</p>
                            </div>
                           
                          
                            </div>
                        </div>
                
                        <li :id="'li_'+frame.id+frame.title" class="list-group-item" v-for="(frame,key,index) in frames" v-bind:key="frame.id" @drop="drop1(frame.title,frame.id,'1','',frame.image.src,SelectFrame.id)" v-if="SelectFrame.frame_id != frame.id" v-bind:style="[li_f ? { 'display': 'block' } : { 'display': 'none' }]">
                       <p  v-bind:style="{ 'display': 'none' }">{{ flag_f = true }}</p>
                        <p  v-bind:style="{ 'display': 'none' }">{{ flag = true }}</p>
                       
                       
                            <div  v-for="color in selectedColor" >

                            <div v-if="color != frame.id">
                               
                                <p  v-bind:style="{ 'display': 'none' }">{{ flag = true }}</p>
                            </div>
                            <div v-else>
                                <p  v-bind:style="{ 'display': 'none' }">{{ flag = false }}{{ flag_f = false }}</p>

                            </div>
                           
                          
                            </div>
                          
                                <div v-if="flag_f == false"> 
                                    <a href="javascript:void(0);" v-if="flag_f"> 
                                        {{frame.title}}
                                    </a> 
                                </div>
                                <div v-else> 
                                    <a href="javascript:void(0);" v-if="flag"> 
                                        {{frame.title}}
                                    </a> 
                                </div>
                        </li>
                
                    </ul>
                </div>
                <div class="quiz-drag-area">
                    <div class="arrow-box">
                        <img src="images/arrow.png" alt="">
                    </div>
                </div>
                <div class="quiz-drag-area drag-area-right" v-if="show">
                    <h6>Selected Collections</h6> 
                    <ul class="list-group list-group-second" :id="'selectedCollection' + increamentI">
                        <li class="list-group-item" v-for="frame in selectedFrame" v-bind:key="frame.id" @drop="drop1(frame.frame,frame.id,'2',frame.frame_id,frame.frame_img,'')" >
                            <a href="javascript:void(0);">
                                {{ frame.frame }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="quiz-drag-area drag-area-right" v-else>
                    <h6>You Choose {{ SelectFrame.frame }}</h6>
                    <ul class="list-group list-group-second" :id="'selectedCollection' + increamentI">
                        <li class="list-group-item" v-for="frame in selectedFrame" v-bind:key="frame.id" @drop="drop1(frame.frame,frame.id,'2',frame.frame_id,frame.frame_img,'')" v-if="SelectFrame.id == frame.select_frame_id">
                            <a href="javascript:void(0);">
                                {{ frame.frame }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="list-quiz-right" v-if="show">
                <div class="quiz-drag-area quiz-preview-area">
                    <h6>Preview</h6>
                    <div class="quiz-preview-container">
                        <div class="quiz-list-box">
                        <div class="quiz-radio-box" v-for="frame in selectedFrame" v-bind:key="frame.id" v-if="frame.frame_id != dropFrame">
                                <input type="radio" name="categoryname" id="cate1" class="list-radio" />
                                <label for="cate1" class="list-lable">
                                    <span class="list-img" :style="{backgroundImage: 'url('+frame.frame_img+')'}">
                                    </span>
                                    <span class="img-list-name">
                                        <span class="radio-circle"></span>
                                        <span class="radio-list-name">{{frame.frame}}</span>
                                    </span>
                                </label>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-quiz-right" v-else>
                <div class="quiz-drag-area quiz-preview-area" :id="'preview' + increamentI">
                    <h6>Preview</h6>
                    <div class="quiz-preview-container">
                        <div :class="'quiz-list-box preview' + SelectFrame.id">
                        <div class="quiz-radio-box" v-for="frame in selectedFrame" v-bind:key="frame.id" v-if="SelectFrame.id == frame.select_frame_id">
                                <input type="radio" name="categoryname" id="cate1" class="list-radio" />
                                <label for="cate1" class="list-lable">
                                    <span class="list-img" :style="{backgroundImage: 'url('+frame.frame_img+')'}">
                                    </span>
                                    <span class="img-list-name">
                                        <span class="radio-circle"></span>
                                        <span class="radio-list-name">{{frame.frame}}</span>
                                    </span>
                                </label>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <p  v-bind:style="{ 'display': 'none' }">{{ increamentI++ }}</p>
        </div>
        <div class="quiz-area-btn">
            <button class="quiz-btn"  @click="ColorSelection">Next</button>
            <input type="hidden" name="total" id="total" v-model="length">
        </div>
    </div>
    
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
            frames:[],
            show:true,
            choose_option:{
                frame:'',
                frame_id:'',
                frame_img:'',
                select_frame_id:'',
            },
            length:1,
            totalSelectFrame : ['0'],
            totalSelectFrameforColor:[],
            selectedColor :[],
            selectedFrame:[],
            edit:false,
            up_id:'',
            All_id:[],
            sremove:[],
            eexist:[],
            dropFrame:'',
            flag:true,
            flag_f:true

            }
        },
        created(){
            this.selectedData();
            this.fetchData();
        },
        methods:{
            selectedData(){
                if(this.show == true){
                    var url = 'api/getframe'
                }else{
                    var url = 'api/color'
                }
                fetch(url)
                .then(res => res.json())
                .then(res => {
                    if(res){
                        for(var i=0;i<res.data.length;i++){
                            if(this.show == true){
                                this.selectedFrame.push(res.data[i]);
                                this.eexist.push(res.data[i].frame_id)
                            }
                            if(this.colorSec == true){
                                this.selectedFrame.push(res.data[i]);
                                this.selectedColor.push(res.data[i].frame_id);
                            }
                        }
                        //console.log(this.totalSelectFrame);
                        if(this.colorSec == true){
                            let recaptchaScript = document.createElement('script')
                            recaptchaScript.setAttribute('src','http://localhost/MM_Quiz/resources/js/custom.js')
                            document.head.appendChild(recaptchaScript)
                        }
                        console.log(this.length);
                    }            
                })
            },
            fetchData(){
                var url = 'api/frame'
                fetch(url)
                .then(res => res.json())
                .then(res => {  
                    if(res){
                        for(var i=0;i<res.response.length;i++){
                        var flag1 = 0;
                        if(this.show == true){
                            for(var j=0;j<this.eexist.length;j++){
                                if(this.eexist[j] == res.id[i]){
                                    flag1 = 1;
                                }
                            }
                            if(flag1 == 0){
                                this.frames.push(res.response[i]);
                            }
                        }else{
                            this.frames.push(res.response[i]);
                        }
                    }
                   }     
                })
            },
            drop1(title,id,flag,framid,frameimg,sframeId){
           // const button = document.querySelector('.list-group-item')
            //alert('your id:', button.id);
            this.choose_option.frame = title;
            this.choose_option.frame_id = id;
            this.choose_option.frame_img = frameimg;
            this.choose_option.select_frame_id = sframeId;
                if(flag == 1){
                    if(this.show == true){
                        fetch('api/frame',{
                        method:'POST',
                        body:JSON.stringify(this.choose_option),
                        headers:{
                            'content-type':'application/json'
                        }
                        })
                        .then(res => res.json())
                        .then(data => {
                        console.log('hii');
                        console.log(data);
                    this.totalSelectFrameforColor.push(data.data);
                   //this.length = this.totalSelectFrameforColor.length;

                            var preview = '';
                            preview+= '<div class="quiz-radio-box"><input type="radio" name="categoryname" id="cate1" class="list-radio"> <label for="cate1" class="list-lable">';  
                            preview+='<span class="list-img" style="background-image:url('+this.choose_option.frame_img+')"></span>';
                            preview+='<span class="img-list-name"><span class="radio-circle"></span> <span class="radio-list-name">'+this.choose_option.frame+'</span></span></label></div>'
                            $('.quiz-list-box').append(preview);
                            alert('added');


                        })
                        .catch(err => console.log(err))
                    }else{
                        fetch('api/color',{
                        method:'POST',
                        body:JSON.stringify(this.choose_option),
                        headers:{
                            'content-type':'application/json'
                        }
                        })
                        .then(res => res.json())
                        .then(data => {
                            var preview = '';
                            preview+= '<div class="quiz-radio-box"><input type="radio" name="categoryname" id="cate1" class="list-radio"> <label for="cate1" class="list-lable">';  
                            preview+='<span class="list-img" style="background-image:url('+this.choose_option.frame_img+')"></span>';
                            preview+='<span class="img-list-name"><span class="radio-circle"></span> <span class="radio-list-name">'+this.choose_option.frame+'</span></span></label></div>'
                            $('.preview'+sframeId).append(preview);
                            alert('added');

                        })
                        .catch(err => console.log(err))
                    }
                }
                else if(flag == 2){
                    if(this.show == true){
                    this.dropFrame = '';
                        if (confirm('Are You Sure?')) {
                            fetch(`api/frame/${id}`, {
                              method: 'delete'
                            })
                              .then(res => res.json())
                              .then(data => {
                             // console.log(this.choose_option);
                              // console.log(this.eexist);
                             this.dropFrame = framid;
                             this.selectedFrame = [];
                             this.selectedData(); 
                                alert('Frame Removed');
                                console.log(this.selectedFrame)
                              })
                              .catch(err => console.log(err));
                        }
                    }else{
                        if(confirm('Are You Sure?')) {
                            fetch(`api/color/${id}`, {
                              method: 'delete'
                            })
                          .then(res => res.json())
                          .then(data => {
                          console.log(this.choose_option);
                           this.dropFrame = framid;
                             this.selectedFrame = [];
                             this.selectedData(); 
                            alert('Frame Removed');
                            console.log(this.selectedFrame)
                          })
                          .catch(err => console.log(err));
                        }
                    }
                }
            },
            ColorSelection(){
                this.show = false;
                this.colorSec = true;
                this.frames = [];
                 this.totalSelectFrame = this.totalSelectFrame.concat.apply(this.selectedFrame, this.totalSelectFrameforColor);
                 this.length = this.totalSelectFrame.length;
                this.selectedFrame = [];
                this.fetchData();
                this.selectedData();
                $('.quiz-list-box').html('');
            }
            
        }
    }


</script>

latest
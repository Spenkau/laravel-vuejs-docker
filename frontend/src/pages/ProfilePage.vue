<template>
    <div class="personal-area">
        <div class="personal-area_nav">
            <ul>
                <li>
                    <i class=""></i>
                    <RouterLink to="/">Вернуться на главную</RouterLink>
                </li>
                <li>
                    <i class="icon-archive">иконка архива задач</i>
                    <RouterLink :to="'/user/' + user.name + '/archive'">Архив задач</RouterLink>
                </li>
                <li>
                    <i class="icon-invite">иконка приглашения</i>
                    <a href="#">Приглашение на задачу</a>
                </li>
                <li>
                    <i class="icon-logout">иконка выхода</i>
                    <a href="#">Выйти</a>
                </li>
            </ul>
        </div>
        <div class="personal-area_body">
            <form class="personal-area_body-info">
                <div class="form-header">
                    <div class="avatar" id="avatar">
<!--                        <img src="../../../../public/images/avatar.png" alt="User Avatar" id="avatar-img">-->
                        <v-file-input clearable label="File input" variant="solo-filled">
                        </v-file-input>

                    </div>
                    <div>
                        <div class="user-name">
                            <v-text-field name="username" :label="user.name || ''"></v-text-field>

                        </div>
                    </div>
                </div>
                <div class="user-about">
                    <div>
                        <v-textarea name="user-desc" cols="30" rows="10" maxlength="255" label="Я Такой такой то человек, у меня много много дел"></v-textarea>
                        <p class="about-length len-hidden">Длина рассказа: <span></span>/255</p>
                    </div>
                </div>
            </form>

            <ul class="user-task-list">
                <li v-for="(userTask,key) in tasks" :key="key">
                    <MiniTaskCard :task="userTask"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import MiniTaskCard from "../components/widgets/MiniTaskCard.vue";
import {useUserStore} from "../dict/store/store";
import {storeToRefs} from "pinia";
import {ITask} from "../interfaces/interfaces.ts";

const userTasks = ref<ITask[]>([])

const store = useUserStore()
const {user, tasks} = storeToRefs(store)

console.log(tasks.value)

declare global {
  interface Window {
    Echo: any;
  }
}

onMounted(() => {
    try {
        window.Echo.channel('task-channel')
            .listen('.task.created', (e: any) => {
                console.log(e.task);
                userTasks.value.unshift(e.task)
            })
            .error((error: any) => {
                console.error('Error:', error);
            })
    } catch (e) {
        console.error(e)
    }
})



</script>

<style scoped lang="scss">
@import "../css/general";

.user-task-list{
    margin-top: 60px;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 90%;
}

.icon-edit {
    @include icon(24px, 24px, 'edit');
}

.icon-apply {
    @include icon(24px, 24px, 'apply');
}

.icon-change {
    @include icon(32px, 32px, 'change')
}

.personal-area {
    display: flex;
    min-height: 100vh;

    .icon-archive {
        @include icon(25px, 25px, 'archive');
    }

    .icon-invite {
        @include icon(25px, 25px, 'invite');
    }

    .icon-logout {
        transform: rotate(180deg);
    }
}


.personal-area_nav {
    //position: absolute;
    background-color: $abs-white;
    font-size: 18px;
    padding-right: 30px;
    padding-top: 30px;
    padding-left: 30px;
    height: fit-content;

    li {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    a {
        color: $black;
        display: block;
        cursor: pointer;
    }
}


.personal-area_body {
    width: 100%;
    padding: 30px 30px 30px 100px;
}

.personal-area_body-info {
    display: block;

    h2 {
        font-size: 38px;
    }

    img {
        width: 128px;
    }

}

.button-edit {
    background-color: transparent;
    border: none;
    cursor: pointer;

}

.user-name {
    width: 30vw;
    display: flex;
    gap: 10px;

}

.form-header {
    display: flex;
    gap: 30px;
    align-items: center;
    justify-content: space-around;
    width: 80%;
    margin-bottom: 40px;
}

.user-about {
    padding-top: 30px;
    width: 90%;

    textarea {
        resize: none;
        font-size: 19px;
        font-family: $main-font;
        background-color: $abs-white;
        border: 1px solid $green;
        border-radius: 5px;
        height: 150px;


    }

    textarea[disabled="disabled"] {
        background-color: transparent;
        border: 1px solid transparent;
    }

    align-items: flex-start;
    gap: 150px;
}


.avatar {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: relative;
    cursor: pointer;

    img {
        object-fit: cover;
    }

}

#change-avatar {
    position: relative;
    border-radius: 5px;
    background-color: white;
    right: 60px;
    top: 50px;
    border: none;
    cursor: pointer;
}

.len-hidden {
    display: none;
}

</style>

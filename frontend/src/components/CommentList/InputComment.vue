<template>
    <div class="write-comment">
        <v-text-field
            v-model="comment"
            clearable
            type="text"
            label="Оставьте комментарий для задачи.."
            name="comment"
            variant="underlined"
        ></v-text-field>
        <v-btn
            type="submit"
            text="Отправить"
            @click.prevent="postComment"
            :disabled="!comment"
        ></v-btn>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import {useUserStore} from "../../dict/store/store";
import api from "../../dict/axios/api";

const props = defineProps(['id'])
const comment = ref("")



const postComment = () => {
    const userComment = comment.value
    const store = useUserStore()

    const commentData = {
        // user_id: store.user.id,
        // user_name:store.user.name,
        task_id:props.id,
        content: userComment

    }
    api.post('comment/store',commentData).then(res => console.log(res))
}

</script>

<style scoped lang="scss">
@import "../../css/general";

.write-comment {
    margin-top: 80px;
    width: 100%;

    input[type="submit"] {
        margin-left: 90%;
        padding: 8px;
        border: none;
        background-color: transparent;
        opacity: 0.4;
        font-family: $main-font;
        border-radius: 15px;
        cursor: pointer;

        &:hover {
            opacity: 1;
            background-color: $green;
            color: $abs-white;
        }
    }
}
</style>

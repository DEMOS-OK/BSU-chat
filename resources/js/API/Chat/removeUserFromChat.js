/**
 * Send async request to remove user from chat
 *
 * @param {number} userId
 * @param {number} chatId
 */
const removeUserFromChat = async (userId, chatId) => {
    const response = await axios.post(
        route("chat.remove-user", {
            user_id: userId,
            chat_id: chatId,
        })
    );

    return response.status === 200 && response.data.success;
};

export default removeUserFromChat;

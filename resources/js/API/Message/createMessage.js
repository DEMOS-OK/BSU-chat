/**
 * Send async request to create message
 *
 * @param {string} text
 * @param {number} userId
 * @param {number} chatId
 * @returns {Promise<void>}
 */
const createMessage = async (text, userId, chatId) => {
    return axios.post(
        route("message.store", {
            text: text,
            user_id: userId,
            chat_id: chatId,
        })
    );
};

export default createMessage;

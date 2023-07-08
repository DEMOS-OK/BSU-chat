/**
 * Send async request to get more messages
 *
 * @param {number} chatId
 * @param {number} step
 * @returns {Promise<void>}
 */
const loadMoreMessages = async (chatId, step = 0) => {
    return axios.get(
        route("messages.load-more", {
            chat_id: chatId,
            step: step,
        })
    );
};

export default loadMoreMessages;

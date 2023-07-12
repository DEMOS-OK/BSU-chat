/**
 * Send async request to create new chat
 *
 * @param {string} title
 * @param {array<Number>} users
 */
const createChat = async (title, users = []) => {
    const response = await axios.post(
        route("chat.store", {
            title: title,
            users: users,
        })
    );

    return response.status === 200 && response.data.success;
};

export default createChat;

<template>
  <div class="flex flex-wrap">
    <ShareNetwork
      v-for="network in networks"
      :network="network.network"
      :key="network.network"
      :url="url"
      :title="title"
      :description="description"
      :hashtags="sharing.hashtags"
      :twitterUser="sharing.twitterUser"
      class="inline-flex p-3 -ml-3 transition-colors text-black hover:text-red duration-300 ease-in-out"
      tag="button"
      :aria-label="network.network"
    >
      <component :is="network.icon" />
    </ShareNetwork>
  </div>
</template>

<script>

export default {
  name: 'SocialShare',
  props: {
    url: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      sharing: {
        hashtags: 'wordpress-starter',
        twitterUser: 'wordpress-starter'
      },
      networks: [
        { network: 'linkedin', name: 'LinkedIn', icon: 'icon-linkedin', color: '#007bb5' },
        { network: 'twitter', name: 'Twitter', icon: 'icon-twitter', color: '#1da1f2' },
        { network: 'facebook', name: 'Facebook', icon: 'icon-facebook', color: '#1877f2' },
        { network: 'whatsapp', name: 'Whatsapp', icon: 'icon-whatsapp', color: '#25d366' },
        { network: 'messenger', name: 'Messenger', icon: 'icon-messenger', color: '#0084ff' },
        { network: 'sms', name: 'SMS', icon: 'icon-sms', color: '#333333' },
      ]
    }
  }
}
</script>

import discord,requests
from discord.ext import commands

bot = commands.Bot(command_prefix='+', help_command=None, intents=discord.Intents.all())

### -- EDIT THIS LINE -- ###
vouch_channel_id = 1132899535371370597
endpoint_url = ""
api_key = "eagleishot"
token = ""

@bot.command()
async def vouch(ctx, *args):
    msg = " ".join(args)
    if ctx.channel.id != vouch_channel_id:
        await ctx.reply(f"You can't use this command here, only in <#{vouch_channel_id}>")
        await ctx.message.delete()
        return
    if len(msg) > 150:
        await ctx.author.send("Your message is too long, please keep it under 150 characters.")
        await ctx.message.delete()
        return
    r = requests.post(endpoint_url, json = {"discord_tag": ctx.author.name,"discord_id": ctx.author.id,"vouch_content": {"message_id": str(ctx.message.id),"content": "vouch " + msg},"api_key": api_key})
    await ctx.reply("Thank you!")

bot.run(token)

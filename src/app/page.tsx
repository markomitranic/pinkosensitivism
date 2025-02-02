import { paginatePosts } from "~/lib/PostRepository";

export default async function Home() {
  const posts = await paginatePosts(1, 3);

  return (
    <main className="">
      <div className="">
        {/* <ul className="grid grid-cols-2 gap-4 md:grid-cols-3">
          {posts.map((post) => (
            <li
              key={post.id}
              className="debug relative block aspect-square h-full w-full overflow-hidden"
            >
              <a href={post.url}>
                <Image
                  src={post.url}
                  alt=""
                  width={400}
                  height={400}
                  className="h-full w-full rounded-md object-cover"
                />
              </a>
            </li>
          ))}
        </ul> */}
        <ul>
          <li className="debug block h-20 w-20 bg-amber-800">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
          <li className="block h-20 w-20 bg-red-700">ddd</li>
        </ul>
      </div>
    </main>
  );
}

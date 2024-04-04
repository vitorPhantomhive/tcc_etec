using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("escola")]
    public class Escola
    {
        
        //métudo de update para usar na controller quando a rota for put
        public void Update(string nome, string cnpj, string email, string senha)
        {
            Nome = nome;
            CNPJ = cnpj;
            Email = email;
            Senha = senha;
        }

        public int Id { get; set; }
        public string Nome { get; set; }
        public string CNPJ { get; set; } //UNIQUE
        public string Email { get; set; } // UNIQUE
        public string Senha { get; set; }


    }
}

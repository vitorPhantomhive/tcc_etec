using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("escola")]
    public class Escola
    {
        public Escola(string nome, string cNPJ, string email, string senha)
        {
            Nome = nome;
            CNPJ = cNPJ;
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
